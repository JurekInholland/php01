<?php
// Fetch information about a browser request

class Request {

    // Return a request's uri
    public static function uri() {
        // Parse url; remove any parameters and return only the uri
        return trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
    }

    // Return a request's method (get, post..)
    public static function method() {
        return $_SERVER["REQUEST_METHOD"]; 
    }

    // todo add parameters
} 