<?php

class controllerBase {
    public $model;
    public $view;

    function __construct()
    {
        //$this->view = new View();
    }

    public function defaultAction(){
        //TODO connections with model
    }
}