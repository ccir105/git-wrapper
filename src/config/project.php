<?php
/**
 * Basic Configuration of project for specially prefixing names of repositories and branch
 * %d represents unique identifiers of entities
 * Created by PhpStorm.
 * User: sishir
 * Date: 4/6/16
 * Time: 7:34 PM
 */

return [
    'prefix' => [
        'project' => 'project-%d',
        'task' => 'branch-%d-init',
        'assigned_task'=>'branch-%d-user-%d'
    ]
];