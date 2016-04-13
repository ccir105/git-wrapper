<?php
/**
 * Created by PhpStorm.
 * User: sishir
 * Date: 4/6/16
 * Time: 2:01 PM
 */

namespace Shokse\ProjectApi\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = ['type','name','status','description','skills','environment','start_time','end_time'];

    public function company(){
        return $this->belongsTo('Shokse\ProjectApi\Models\User','company_id','id');
    }

    public function tasks(){
        return $this->belongsTo('Shokse\ProjectApi\Models\Task');
    }
}