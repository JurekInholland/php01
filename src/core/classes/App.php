<?php
// PHP Injection controller / DI container

// Storage container following singleton pattern
class App {
    protected static $items = [];
    
    public static function bind($key, $value) {
        static::$items[$key] = $value;
    }
    public static function get($key) {
        
        if (array_key_exists($key, static::$items)) {
            return static::$items[$key];
        } else {
            throw new Exception("No {$key} found in the App container.");
        }
    }
}
