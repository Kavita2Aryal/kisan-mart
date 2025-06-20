<?php

if (!function_exists('search_filter_int')) {
 
    function search_filter_int($value, $default_value)
    {
        $filtered_value = filter_var($value, FILTER_VALIDATE_INT);
        return $filtered_value > 0 ? $filtered_value : $default_value;
    }
}

if (!function_exists('search_filter_string')) {
 
    function search_filter_string($value)
    {
        return filter_var($value, FILTER_SANITIZE_STRING);
    }
}