<?php
/**
 * Die Konfig Datei mit den Konstante zu für de Pfade
 */
require_once('config/config.php');

/**
 * Helper Funtionen
 */
require_once('helpers/url_helper.php');
require_once('helpers/session_helper.php');

/**
 * App Core Klasse
 * Die App Core Klasse generiert die URL und lädt den Core Controller
 * Das URL FORMAT ist wie folgt - domain/controller/method/params
 */
/* require_once('libraries/Core.php');
require_once('libraries/Controller.php');
require_once('libraries/Database.php'); */
// (wird durch autoloader ersetzt)

spl_autoload_register(function($className) {
    require_once('libraries/' . $className . '.php');
});


$init = new Core();