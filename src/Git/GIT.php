<?php
/**
 * Created by PhpStorm.
 * User: sishir
 * Date: 4/6/16
 * Time: 2:52 PM
 */
namespace Shokse\ProjectApi\Git;

class GIT
{
    protected $logger;

    protected $git;

    protected $prefix = [];

    public function __construct()
    {
        $this->prefix = config('project.prefix');
        $this->logger = app()->make('Shokse\ProjectApi\Logger\LoggerInterface');
        $this->git = app()->make('Shokse\ProjectApi\Git\GitInterface');
    }

    public function log($message)
    {
        $this->logger->log($message . '   --' . date('Y-m-d H:i:s'));
    }

    public function createRepo($name)
    {
        $this->git->createRepository($name);
        $this->log('Repository named "' . $name . '" is created');
    }

    public function deleteRepo($name)
    {
        $this->git->deleteRepository( $name);
        $this->log('Repository named "' . $name . "' is deleted");
    }

    public function createBranch($name, $branch)
    {
        $this->git->createBranch($name, $branch);
        $this->log('Branch named "' . $branch . '" is created on repository ' . "' " . $name . "'");
    }

    public function forkFromBranch($name, $source, $new)
    {
        $this->git->forkBranch($name, $source, $new);
        $this->log('A new branch named "' . $new . "' is forked from branch named " .$source. '" on repository " ' . $name . '"');
    }

    public function deleteBranch($name, $branch)
    {
        $this->git->deleteBranch($name, $branch);
        $this->log('Branch named "' . $branch . '" is deleted on repository' . "'" . $name . "'");
    }

    public function commit( $name, $branch, $message )
    {
        $this->git->commit( $name, $branch, $message );
        $this->log('A new commit has been made on branch named "' . $branch . '" on repository' . "'" . $name . "'. The commit message is " . $message);
    }

    public function merge($name, $branchA, $branchB)
    {
        $this->git->commit($name, $branchA, $branchB);
        $this->log('Branch named ' . $branchA . '" is merged with branch named ' . "'" . $branchB . "' on repository " . $name);
    }

    public function getRepoName( $id )
    {
        return sprintf( $this->prefix['project'], $id );
    }

    public function getBranchName( $id )
    {
        return sprintf( $this->prefix['task'], $id );
    }

    public function getAssignedBranchName($taskId , $userId)
    {
        return sprintf( $this->prefix['assigned_task'], $taskId, $userId) ;
    }
}