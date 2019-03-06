<?php

class listUsersController extends controllerBase
{
    public function defaultAction()
    {
        $this->model = new listUsersModel();
        $data = $this->model->getData();
        if(!empty($data)){
            $this->view = new listUsersView($data);
        }
    }
}