<?php

//This is the Controller class which handles the input from the user.
class Controller {
     
    protected $model;
    protected $view;
     
    public function __construct(Model $model) {
        $this->view = new View();
        $this->model = $model;   
    } 
}