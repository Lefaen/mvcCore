<?php
class signUpModel extends modelBase{



    function valid($login, $pass, $email)
    {
        //TODO validity of the entered data
        return true;
    }

    function signUp(){
        if(!empty($_POST['login']) && !empty($_POST['pass']) && !empty($_POST['email'])) {
            if($this->valid($_POST['login'], $_POST['pass'], $_POST['email'] == true)){
                $data['login'] = $_POST['login'];
                $data['pass'] = $_POST['pass'];
                $data['email'] = $_POST['email'];
                $this->setData($data);

                $user = user::getUser();
                $user->signUp($data['login'], $data['pass'], $data['email']);
            }
        }
    }

    function __construct()
    {
        $this->signUp();
    }
}