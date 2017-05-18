<?php

class View {
 
    public function __construct() {
         
    }
 
    public function render($name, $data = FALSE) {
        if ($data != FALSE) {
             extract($data);
        }
        require(BASE_PATH .DS. "views" .DS. "default" .DS."baseHeader.php");
        require(BASE_PATH .DS. "views" .DS. $name . ".php");//content
        require(BASE_PATH .DS. "views" .DS. "default" .DS."baseFooter.php");
    }
}