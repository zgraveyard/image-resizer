<?php

$dotenv = new Dotenv\Dotenv(__DIR__.'/../','.env');
$dotenv->load();


if(!function_exists('env'))
{
    function env($value, $default = null)
    {
        return getenv($value) ?: $default;
    }
}