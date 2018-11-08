<?php

function url($uri = '')
{
    $path = 'http://' . $_SERVER['SERVER_NAME'] . ( ($_SERVER['SERVER_PORT'] != 80) ? ':' . $_SERVER['SERVER_PORT'] : '') . '/';

    if($_SERVER['DOCUMENT_ROOT'] != __DIR__)
    {
        $path .= basename(__DIR__).'/';
    }

    $path .= trim($uri,'/');

    return $path;
}