<?php
/**
 * Created by PhpStorm.
 * User: sishir
 * Date: 4/6/16
 * Time: 1:37 PM
 */
namespace Shokse\ProjectApi;
use Shokse\ProjectApi\Models\Task;
use Shokse\ProjectApi\Git\GIT;

class TaskManager {

    protected $task;

    protected $gitApi;

    /**
     * TaskManager constructor.
     * Git Api caller is injected from the controller
     * It holds database logging and git api caller
     */

    public function __construct()
    {
        $this->task = new Task();
        $this->gitApi = new GIT();
    }

    /**
     * Find Task By Id
     * @param $taskId
     */
    public function find($taskId)
    {
        return $this->task->find($taskId);
    }

    /**
     * Creates A new task
     * @param array $request
     * @param $project
     * @param null $task
     * @return bool
     */
    public function save( array $request, $project , $task = null )
    {
        $taskModel = is_null($task) ? $this->task : $task;

        $taskModel->fill($request);

        $taskModel->project_id = $project->id;

        $status = $taskModel->save();

        if( is_null( $task ) )
        {
            $projectRepo = $this->gitApi->getRepoName( $project->id );

            $taskBranch = $this->gitApi->getBranchName( $taskModel->id );

            $this->gitApi->createBranch( $projectRepo, $taskBranch );
        }

        return $status;
    }

    /**
     * Remove Task
     * @param $task
     * @return bool
     */
    public function remove( $task )
    {
        $projectRepo = $this->gitApi->getRepoName( $task->project->id );

        $taskBranch = $this->gitApi->getBranchName($task->id);

        $status = $task->delete();

        $this->gitApi->deleteBranch( $projectRepo, $taskBranch );

        return $status;
    }

    /**
     * Assign Task To Student
     * @param $task
     * @param $programmer
     * @return bool
     */

    public function assign( $task, $programmer )
    {
        if( !$task->isAssignedTo($programmer) ) {

            $project = $task->project;

            $projectRepo = $this->gitApi->getRepoName($project->id);

            $taskBranch = $this->gitApi->getBranchName($task->id);

            $assignedBranch = $this->gitApi->getAssignedBranchName($task->id, $programmer->id);

            $task->users()->save($programmer);

            $this->gitApi->forkFromBranch($projectRepo, $taskBranch, $assignedBranch);

            return true;
        }

        return false;
    }

    public function submit( $task, $programmer , $message = 'A Commit Message'){

            $repoName = $this->gitApi->getRepoName($task->project->id);

            $branchName = $this->gitApi->getAssignedBranchName( $task->id, $programmer->id );

            $this->gitApi->commit($repoName,$branchName,$message);

            $task->submitted = 1;

            return $task->save();
    }

    public function accept( $task, $programmer ){

            $toMergeBranch = $this->gitApi->getBranchName($task->id);

            $branchName = $this->gitApi->getAssignedBranchName( $task->id, $programmer->id );

            $project = $task->project;

            $repoName = $this->gitApi->getRepoName($project->id);

            $this->gitApi->merge($repoName, $branchName , $toMergeBranch );

            $task->completed = 1;

            return $task->save();
    }
}