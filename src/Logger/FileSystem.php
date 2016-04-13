<?php
/**
 * Created by PhpStorm.
 * User: sishir
 * Date: 4/6/16
 * Time: 8:49 PM
 */

namespace Shokse\ProjectApi\Logger;
use File;
class FileSystem implements LoggerInterface
{
    public function log($message)
    {
        $message = '[*] ' . $message . PHP_EOL;
        File::append(storage_path('project.gitlog'), $message);
    }
}