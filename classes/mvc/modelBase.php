<?php

class modelBase {
    private $data = null;

    public function getData(){
        return $this->data;
    }
    public function setData($data){
        $this->data = $data;
    }
}