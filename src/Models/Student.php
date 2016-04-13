<?php
/**
 * Created by PhpStorm.
 * User: sishir
 * Date: 4/6/16
 * Time: 3:43 PM
 */

namespace Shokse\ProjectApi\Models;


use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    public function user(){
        return $this->hasOne('Shokse\ProjectApi\Models\User','id','user_id');
    }
}