<?php

class viewBase
{
    public function show($data){
        var_dump($data);
    }

    public function __construct($data = null)
    {
        $this->show($data);
    }
}