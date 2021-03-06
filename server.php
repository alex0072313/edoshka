<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';

if (preg_match('/^(.+)\.(\d+)\.(css|gif|jpeg|jpg|js|png|svg)$/', $uri, $matches))
{
    exit();
    $requested = $paths['public'].$matches[1].'.'.$matches[3];
    if (file_exists($requested))
    {
        $types = array(
            'css' => 'text/css',
            'gif' => 'image/gif',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'svg' => 'image/svg+xml'
        );
        header('Content-type: '.$types[$matches[3]]);
        readfile($requested);
        exit;
    }
}
