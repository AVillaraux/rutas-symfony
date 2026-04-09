<?php

namespace App\config;

class App
{
    static function Config(){
        $url='https://'.$_SERVER["HTTP_HOST"]. $_ENV['CARPETA_PROYECTO'];
        $version=$_ENV['VERSION'].'.'.rand(0,40).'.'.rand(0,20);
        define('PATH_SITE', $url);
        define('VERSION', $version);
        define("MODE", $_ENV['MODE']);
        define("DB_HOST", $_ENV['DB_HOST']);
        define("DB_USER", $_ENV['DB_USER']);
        define("DB_PASSWORD", $_ENV['DB_PASSWORD']);
        define("DB_NAME", $_ENV['DB_NAME']);
        define("MAIL_PORT",$_ENV['MAIL_PORT']);
        define("MAIL_HOST", $_ENV['MAIL_HOST']);
        define("MAIL_USER", $_ENV['MAIL_USER']);
        define("MAIL_PASSWORD", $_ENV['MAIL_PASSWORD']);
    }
}
