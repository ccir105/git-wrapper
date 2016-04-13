<?php
/**
 * Created by PhpStorm.
 * User: sishir
 * Date: 4/6/16
 * Time: 7:42 PM
 */

namespace Shokse\ProjectApi\Git;


interface GitInterFace
{
    public function createRepository($name);

    public function deleteRepository($name);

    public function createBranch($name, $branch);

    public function forkBranch($name, $source, $new);

    public function deleteBranch($name, $branch);

    public function commit( $name, $branch, $message );

    public function merge($name, $branchA, $branchB);
}