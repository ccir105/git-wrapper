<?php
/**
 * Created by PhpStorm.
 * User: sishir
 * Date: 4/6/16
 * Time: 5:05 PM
 */

namespace Shokse\ProjectApi\Models;


use Illuminate\Database\Eloquent\Model;

class GitLog extends Model
{
    protected $table = 'git_logs';

    protected $fillable = ['log'];
}