<?php

namespace Engine;

use Engine\Core\Config\Config;
use Engine\Core\Router\DispatchedRoute;
use Engine\Helper\Common;

class Cms 
{
   /**
    * @var DI
   */
   private $di;

   public $router;


   /**
   * Cms constructor.
   * @param $di
   */

   public function __construct($di)
   {
      $this->di = $di;
      $this->router = $this->di->get('router');
   }


   /**
   * Run Cms
   */
   public function run()
   {
      $this->router->add('home', '/', 'HomeController:index');
      $this->router->add('news', '/news', 'HomeController:news');
      $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPathUrl());

      list($class, $action) = explode(':', $routerDispatch->getController(), 2);

     // $controller = '\\' . ENV . '\\Controller\\' . $class;
     $controller = '\\Cms\\Controller\\' . $class;
      call_user_func_array([new $controller($this->di), $action], $routerDispatch->getParameters());
    //  $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getpathUrl());
    //  print_r($this->di);
   // print_r($_SERVER);
    //  print_r($class);
    //  echo '<br>';
    //  print_r($action); 
   //  echo Common::getpathUrl();
    // echo Common::getMethod();
   }

}