<?php

class signInView extends viewBase
{

    public function signIn()
    {
        ?>

        <form action="" method="post">
            <label>
                Логин:
                <input type="text" name="login"/>
            </label>
            <label>
                Пароль:
                <input type="password" name="pass"/>
            </label>
            <input type="submit" name="send" value="войти"/>
        </form>

        <a href="/?signUp=true">зарегистрироваться</a>

        <?
    }

    public function logout()
    {
        ?>

        <form action="" method="post">
            <input type="submit" name="logout" value="выйти"/>
        </form>

        <?


    }

    public function profile($data)
    {
        ?>
        <div>
            <span>Логин:</span>
            <?= $data['login'] ?>
        </div>
        <div>
            <span>E-mail:</span>
            <?= $data['email'] ?>
        </div>
        <div>
            <span>Права админа:</span>
            <?= $data['admin'] ?>
        </div>
        <div>
            <? $this->logout(); ?>
        </div>
        <?
    }

    public function show($data)
    {
        if (isset($_GET['signUp']) && $_GET['signUp'] == true) {
            component::includeComponent('signUp');
        } else {
            if (empty($_SESSION['id'])) {
                $this->signIn();
            } else {
                $this->profile($data['user']);
            }
        }
    }

    public function __construct($data = '')
    {
        $this->show($data);
    }
}