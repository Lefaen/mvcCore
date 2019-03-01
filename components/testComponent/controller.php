<?php

class testComponentController extends controllerBase
{
    public function defaultAction()
    {
        $this->model = new testComponentModel();
        $data = $this->model->getData();
        if(!empty($data)){
            $this->view = new testComponentView($data);
        }
    }
}