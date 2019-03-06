<?php

class signUpView extends viewBase
{

    function signUp()
    {
        ?>

        <form action="" method="post">
            <label>Логин:</label><input type="text" name="login" />
            <label>Пароль:</label><input type="password" name="pass" />
            <label>E-mail:</label><input type="text" name="email" />
            <input type="submit" name="signUp" value="Регистрация" />
        </form>

        <?
    }

    public function show($data){
        $this->signUp();
    }

    public function __construct($data = '')
    {
        $this->show($data);
    }
}