<?php
error_reporting(-1);

require __DIR__ . '/functions.php';
require __DIR__ . '/vendor/autoload.php';

spl_autoload_register(function ($class)
{
    foreach (array('app') as $prefix)
        if (file_exists($path = $prefix . '/' . str_replace('\\', '/', $class) . '.php'))
            return require $path;
});

define('BASEPATH', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/');
define('BASEURL', BASEPATH . 'index.php/');

try {
    session_start();
    $routes = require 'routes.php';
    $router = new Minima\Dispatcher($routes);
    if (file_exists('db_config.php') && is_array($db_config = include 'db_config.php')) {
        $db = new PDO($x = 'mysql:host=' . $db_config['host'] . ';port=3306;dbname=' . $db_config['dbname'],
            $db_config['user'], $db_config['pass'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        PotterORM\Base::setDb($db);
        $router->setVariables(array(
            'db' => $db,
        ));
    }
    $router->dispatch();
} catch (Exception $e) {
    var_dump($e->getMessage(), $e->getTraceAsString());
}
