<?php

if (!function_exists('is_active')) {
    function is_active(String $routeName) {
        return null !== request()->segment(2) && request()->segment(2) == $routeName ? 'active' : '';
    }
}

if (!function_exists('getYoutubeId')) {  // This Function To Get Youtube Video Id 
    function getYoutubeId($url){ 
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        return isset($match[1]) ? $match[1] : null;
    }
}

if (!function_exists('slug')) { 
    function slug(String $name){

        return strtolower(trim(str_replace(' ', '_', $name)));
    
    }
}

