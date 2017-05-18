<?php

class Router {
 
    //array to store the requested url
    private static $url = [];
    //private static $method;
     
    //array to store the arguments from the url
    private static $argument = [];
 
    public function __construct() {
         
        $this->parseUrl();
        $this->setArgument();
        $this->initController();    
    }
     
    //parse the url 
    private function parseUrl() {
        //if url is set it returns the url otherwise it returns the index
        self::$url = isset($_GET["url"]) ? $_GET["url"] : "index";
        
        //do the right trim for the url with a delimeter "/"
        self::$url = rtrim(self::$url, "/");
         
        //explode the url separated by delimeter "/" which returns the array
        self::$url = explode("/", self::$url);
    }
     
   //set the arguments http://localhost/scramble/index/view/arguments
    private static function setArgument() {
        //self::$argument = [];
        if (isset(self::$url[2])) {
            $temp = self::$url;
            unset($temp[0], $temp[1]);
            self::$argument = array_merge($temp);
        }
        //return self::$argument;
    }
 
    private function getController() {
        //return the Controller name by capitalizing the first letter
        return ucfirst(self::$url[0]) . "Controller";
    }
 
    private function getModel() {
        //return the Model name by capitalizing the first letter
        return ucfirst(self::$url[0]) . "Model";
    }
 
    private function initController() {
        $ctrl_class = $this->getController();
        $model_class = $this->getModel();
        $this->loadController($ctrl_class, $model_class);
    }
 
    private function loadController($ctrl_class, $model_class) {
        if (!file_exists(BASE_PATH . DS . "controllers" . DS . $ctrl_class . ".php")) {
            $this->error404();
        } else {
            $controller = new $ctrl_class(new $model_class());
             
            if (isset(self::$url[2])) {
                $this->runActionWithArg($controller);
            } else if (isset(self::$url[1])) {
                $this->runAction($controller);
            } else {
                $this->runDefaultAction($controller);
            }
        }
    }
 
    private function error404() {
        $controller = new ErrorController(new ErrorModel());
        $controller->index();
        return false;
    }
 
    //run the default action that is for index page.
    private function runDefaultAction(Controller $controller) {
        if (method_exists($controller, "index")) {
            $controller->index();
        }
    }
 
    //run action without the argument
    private function runAction(Controller $controller) {
        //if (isset(self::$url[1])) {
        if (method_exists($controller, self::$url[1])) {
            $controller->{self::$url[1]}();
        } else {
            $this->error404();
        }
    }
 
    //run action with the given arguments in the url
    private function runActionWithArg(Controller $controller) {
        if (method_exists($controller, self::$url[1])) {
            call_user_func_array(array($controller, self::$url[1]), self::$argument);
        } else {
            $this->error404();
        }
    }
 
}