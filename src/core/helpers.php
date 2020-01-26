<?php

// Generate a series of random characters of specified length
function generateUuid($length=6) {

    // Prepare characters to randomly select from
    $numbers = "1234567890";
    $chars = "abcdefghijklmnopqrstuvwxyz";

    // Add numbers, lower- and uppercase characters
    $charSelection = $numbers . $chars . strtoupper($chars);
    $random = "";
    for ($i = 0; $i < $length; $i++) {
        // Add a random character
        $random .= substr(str_shuffle($charSelection), 0, 1);
    }
    return $random;
}

function createSlug($str, $delimiter = '-'){
    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug;
}