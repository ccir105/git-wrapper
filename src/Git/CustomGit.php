<?php
/**
 * Created by PhpStorm.
 * User: sishir
 * Date: 4/6/16
 * Time: 7:47 PM
 */

namespace Shokse\ProjectApi\Git;


class CustomGit implements GitInterFace
{

    public function createRepository($name)
    {
        // TODO: Implement createRepository() method.
    }

    public function deleteRepository($name)
    {
        // TODO: Implement deleteRepository() method.
    }

    public function createBranch($name, $branch)
    {
        // TODO: Implement createBranch() method.
    }

    public function deleteBranch($name, $branch)
    {
        // TODO: Implement deleteBranch() method.
    }

    public function commit($name, $branch, $message)
    {
        // TODO: Implement commit() method.
    }

    public function merge($name, $branchA, $branchB)
    {
        // TODO: Implement merge() method.
    }

    public function forkBranch($name, $source, $new)
    {
        // TODO: Implement forkBranch() method.
    }
}