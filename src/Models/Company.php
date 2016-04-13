<?php
/**
 * Created by PhpStorm.
 * User: sishir
 * Date: 4/6/16
 * Time: 3:52 PM
 */

namespace Shokse\ProjectApi\Models;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    public function user(){
        return $this->hasOne('Shokse\ProjectApi\Models\User');
    }
}