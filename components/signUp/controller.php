<?php

class signUpController extends controllerBase
{
    public function defaultAction()
    {
        $this->model = new signUpModel();
        $data = $this->model->getData();
        $this->view = new signUpView($data);
    }
}