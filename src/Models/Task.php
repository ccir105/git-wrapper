<?php
/**
 * Created by PhpStorm.
 * User: sishir
 * Date: 4/6/16
 * Time: 2:05 PM
 */

namespace Shokse\ProjectApi\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['name','description','input','output','estimateTime','sequence'];

    public function project(){
        return $this->belongsTo('Shokse\ProjectApi\Models\Project');
    }

    public function users(){
        return $this->belongsToMany('Shokse\ProjectApi\Models\Student','student_tasks','task_id','student_id');
    }

    public function isAssignedTo($user){
        $programmers = $this->users;
        return in_array($user->id,$programmers->lists('id')->toArray());
    }
}