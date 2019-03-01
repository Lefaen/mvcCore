<?php

class modelBase {
    private $data = 'test';


    public function getData(){
        return $this->data;
    }
    public function setData($data){
        $this->data = $data;
    }
}