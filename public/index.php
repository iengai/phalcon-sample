<?php
use Phalcon\Loader;
//use Phalcon\Tag;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

    //Register an autoloader
$loader = new Loader();
$loader->registerDirs(
    [
        "../app/controllers/",
        "../app/models/",
    ]
);
$loader->register();
    
$di = new FactoryDefault();
    
$di->set(
    "db",
    function () {
        return new DbAdapter(
             [
                 "host"     =>"localhost",
                 "username" =>"root",
                 "password" =>"",
                 "dbname"   =>"phalconsample",
             ]
        );
    }
);
    
$di->set(
    "view",
    function () {
        $view = new View();
        $view->setViewsDir("../app/views/");
        return $view;
    }
);

$di->set(
    "url",
    function () {
        $url = new UrlProvider();
        $url->setBaseUri("/phalcon-sample/");
        return $url;
    }
);
/*
$di['tag'] = function () {
    return new Tag();
};
 */

$application = new Application($di);

try {
    $response = $application->handle();
    $response->send();
} catch (\Exception $e) {
    echo "Exception:", $e->getMessage();
}

