<?php

class signInController extends controllerBase
{
    public function defaultAction()
    {
        $this->model = new signInModel();
        $data = $this->model->getData();
        $this->view = new signInView($data);
    }
}