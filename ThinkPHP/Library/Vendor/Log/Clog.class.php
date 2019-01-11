<?php
/**
 * Created by PhpStorm.
 * User: jiqing
 * Date: 18-6-27
 * Time: 上午11:19
 */
namespace Vendor\Log;

require '../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\JsonFormatter;

class Clog {
    public static function setLog($content = [],$msg = "msg",$path_name = "php",$level = Logger::NOTICE ,$name = "cm",$formatter = "line") {
        // create a log channel
        $path = '/tmp/'.$path_name.'.log';
        $log = new Logger($name);
        $stream_handler = new StreamHandler($path, Logger::DEBUG); // 过滤级别
        switch (strtolower($formatter)) {
            case "line":
                $stream_handler->setFormatter(new LineFormatter());
                break;
            case "json":
                $stream_handler->setFormatter(new JsonFormatter());
                break;
            default:
        }
        $log->pushHandler($stream_handler);
        $uid_obj = new UidProcessor();
        $log->pushProcessor($uid_obj);

        $pid_obj = new ProcessIdProcessor();
        $log->pushProcessor($pid_obj);

        // add records to the log
        switch (strtoupper($level)) {
            case Logger::DEBUG:
            case 1:
            case "DEBUG":
                $log->debug($msg,$content);
                break;
            case Logger::INFO:
            case 2:
            case "INFO":
                $log->info($msg,$content);
                break;
            case Logger::NOTICE:
            case 3:
            case "NOTICE":
                $log->notice($msg,$content);
                break;
            case Logger::WARNING:
            case 4:
            case "WARNING":
                $log->warning($msg,$content);
                break;
            case Logger::ERROR:
            case 5:
            case "ERROR":
                $log->error($msg,$content);
                break;
            case Logger::CRITICAL:
            case 6:
            case "CRITICAL":
                $log->critical($msg,$content);
                break;
            case Logger::ALERT:
            case 7:
            case "ALERT":
                $log->alert($msg,$content);
                break;
            case Logger::EMERGENCY:
            case 8:
            case "EMERGENCY":
                $log->emergency($msg,$content);
                break;
            default:
                $log->debug($msg,$content);
        }

        return $uid_obj->getUid();
    }
}

