<?php

// set time zone
date_default_timezone_set('America/New_York');

// constants
define('HOST', '127.0.0.1');
define('PORT', null);
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'job_board');
define('BASEURL', 'http://127.0.0.1/~Dan/cdiabu/ajax/job_board/');

// set include path
set_include_path('/Users/Dan/Sites/cdiabu/ajax');

// autoload classes
spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class);
    require_once $path . '.php';
});

// debug
$app['debug'] = TRUE;

// database
try {
    $host = HOST;
    $port = PORT;
    $database = DATABASE;
    $app['db'] = $app->share(function() use ($app, $host, $port, $database) {
        $pdo = new \PDO("mysql:host=$host;port=$port;dbname=$database", USERNAME, PASSWORD);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
        return $pdo;
    });
} catch (\PDOException $e) {
    echo $e->getMessage();
    exit();
}

// services
$app['job'] = function($app) {
    return new CDIA\Job($app);
};

?>