<?php

class IndexController extends Controller {
     
    //This is the controller class for index page which inherits from the Controller
    public function __construct(Model $model) {
        parent::__construct($model);
         
    }
     
    public function index()
    {
        $data["title"] = "Show me what u made of ;)";
        $this->view->render("index/index", $data);
    }

    public function coro($i)
    {
        echo "kakus ".$i;
        $this->view->render("index/index", $i);
    }
}