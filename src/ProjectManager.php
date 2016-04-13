<?php
namespace Shokse\ProjectApi;
use Shokse\ProjectApi\Models\Project;
use Shokse\ProjectApi\Git\GIT;

class ProjectManager
{
    protected $project;

    protected $gitApi;

    public function __construct()
    {
        $this->project = new Project();
        $this->gitApi = new GIT();
    }

    /**
     * Creates A new Project
     * @param array $request Input Array
     * @param $company Comapany Id
     * @param null $project ProjectId (mandatory) Project Unique Id
     * @return bool
     */

    public function save(array $request, $company ,$project = null)
    {
         $projectModel = is_null($project) ? $this->project : $project;

         $projectModel->fill($request);

         $projectModel->company_id = $company->id;

         $status = $projectModel->save();

         /**
         * calling git api when new project request
         **/

        if( is_null( $project ) )
        {
            $this->gitApi->createRepo( $this->getProjectRepoName( $projectModel->id ) );
        }

        return $status;
    }

    /**
     * Remove Project By ID
     * @param $project
     * @return bool
     */
    public function remove( $project )
    {
        $status = $project->delete();

        $this->gitApi->deleteRepo( $this->getProjectRepoName( $project->id ) );

        return $status;

    }

    /**
     * Get All projects
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->project->all();
    }

    /**
     * Get Project Repository name by id
     * @param $projectId
     * @return string
     */
    public function getProjectRepoName($projectId)
    {
        return $this->gitApi->getRepoName($projectId);
    }
}