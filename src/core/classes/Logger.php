<?php

/**
 * Loggger helper class

 * @example
 * 
 * Logger::info("This is an info level message");
 * Logger::warn("This is a warning");
 * 
 */

class Logger {

    private static $filename = "log.txt";
    private static $filepath = "../logs";


    public static function error(string $msg) {
        self::log("ERROR - {$msg}");
    }

    public static function warn(string $msg) {
        self::log("WARNING - {$msg}");
    
    }
    public static function info(string $msg) {
        self::log("INFO - {$msg}");
    }

    public static function debug(string $msg) {
        self::log("DEBUG - {$msg}");
    }


    public static function log(string $msg) {

        $fileP =  self::$filepath . "/" . self::$filename;

        $handle = fopen($fileP, "a");

        $output = self::format($msg);

        flock($handle, LOCK_EX);
        fwrite($handle, $output);
        flock($handle, LOCK_UN);
        fclose($handle);
        return true;

    }

    private static function format($msg) {
        $datetime = date("Y-m-d H:i:s");
        return "[{$datetime}] - {$msg}\n";
    }

}