<?php

class signInModel extends modelBase
{

    function valid($login, $pass)
    {
        //TODO validity of the entered data
        return true;
    }

    public function signIn()
    {
        if (!empty($_POST['login']) && !empty($_POST['pass'])) {
            if ($this->valid($_POST['login'], $_POST['pass'])) {
                $data['login'] = $_POST['login'];
                $data['pass'] = $_POST['pass'];
                $user = user::getUser($data['login']);
                $user->signIn($data['login'], $data['pass']);
                $this->setData($data);
            }
        }
    }

    public function logout()
    {
        if (!empty($_POST['logout'])) {
            user::getUser()->logout();
        }
    }

    public function profile()
    {

        if (!empty($_SESSION['id'])) {
            $user = user::getUser();

            $data['user']['login'] = $user->getLogin();
            $data['user']['email'] = $user->getEmail();
            if ($user->getIsAdmin() == 'true') {
                $data['user']['admin'] = 'Есть';
            } else {
                $data['user']['admin'] = 'нет';
            }

            $this->setData($data);
        }
        if (!empty($_POST['logout'])) {
            $this->logout();
        }

    }

    public function __construct()
    {
        $this->signIn();
        $this->profile();

    }

}