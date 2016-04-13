<?php
/**
 * Created by PhpStorm.
 * User: sishir
 * Date: 4/6/16
 * Time: 7:01 PM
 */

namespace Shokse\ProjectApi\Logger;
use Shokse\ProjectApi\Models\GitLog;

class Database implements LoggerInterface
{
    public function log($message)
    {
        $logger = new GitLog();
        $logger->log = $message;
        return $logger->save();
    }
}