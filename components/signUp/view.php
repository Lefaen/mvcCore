<?php

class signUpView extends viewBase
{

    function signUp()
    {
        ?>

        <form action="" method="post">
            <label>Логин:
                <input type="text" name="login"/>
            </label>
            <label>
                Пароль:
                <input type="password" name="pass"/>
            </label>
            <label>
                E-mail:
                <input type="text" name="email"/>
            </label>
            <input type="submit" name="signUp" value="Регистрация"/>
        </form>

        <?
    }

    public function show($data)
    {
        $this->signUp();
    }

    public function __construct($data = '')
    {
        $this->show($data);
    }
}