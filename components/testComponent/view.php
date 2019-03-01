<?php

class testComponentView extends viewBase
{
    public function show($data){
        print_r($data);
    }

    public function __construct($data = '')
    {
        $this->show($data);
    }
}