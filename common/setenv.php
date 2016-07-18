<?php
error_reporting(E_ALL);

if(!defined("SYSBASE")) define("SYSBASE", str_replace("\\", "/", realpath(dirname(__FILE__)."/../")."/"));

if(trim(substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "/")), "/") != "setup.php") define("DOCBASE", getenv("BASE"));

$http = "http";
if((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== "off") || $_SERVER['SERVER_PORT'] == 443) $http .= "s";
define("HTTP", $http);
