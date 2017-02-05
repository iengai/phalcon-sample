<?php
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlProvider;
error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {


    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();


    
  
    
    
    
    ///////////////////////////////////
    /**
     * Read services
     */
    include APP_PATH . "/config/services.php";
    /*上のservices.phpの中に既に内包されている(dont forget use Phalcon\****
//***********************************************
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
             $url->setBaseUri("/tutorial/");
             return $url;
             }
             );
    */
    ////////////////////////////////////
    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();
    
    
    
    
    //////////////////////////////////////
    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';
    /*上のloader.phpに内包されている(dont forget use Phalcon\*******
//***********************************************
    //Register an autoloader
    $loader = new Loader();
    $loader->registerDirs(
                          [
                          "../app/controllers/",
                          "../app/models/",
                          ]
                          );
    $loader->register();
    */
    /////////////////////////////////////////
    
    
    
    
    ///////////////////////////////////////
    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();
    /*上のと同じ(dont forget use Phalcon\*******
    //***********************************************
    $application = new Application($di);
     
    $response = $application->handle();
     
    $response->send();
    */
    /////////////////////////////////////////

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
