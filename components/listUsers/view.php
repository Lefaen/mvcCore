<?php

class listUsersView extends viewBase
{
    public function listUsers($data)
    {
        ?>
        <div>
            <span>ID</span>
            <span>LOGIN</span>
            <span>EMAIL</span>
            <span>isAdmin</span>
        </div>
        <?

        if (!empty($data)):?>
            <form action="" method="post">
            <? foreach ($data as $user):?>

                <div>

                    <span><?= $user['id']; ?></span>
                    <span><?= $user['login']; ?></span>
                    <span><?= $user['email']; ?></span>
                    <span><?= $user['isAdmin']; ?></span>
                    <a href="?id=<?= $user['id']?>&edit=true">изменить</a>
                    <input type="checkbox" name="<?=$user['id'];?>" value="id">
                </div>
            <? endforeach; ?>
                <input type="submit" value="Удалить" name="remove">
            </form>
        <? endif; ?>
        <?
    }

    private function addUser()
    {
        component::includeComponent('signUp');
    }
    private function editUser($id)
    {
        ?>
        <div>Изменить пользователя</div>
        <form action="/main" method="post">
            <input hidden name="id" value="<?=$id;?>">
            <label>Логин</label><input type="text" name="login" />
            <label>E-mail</label><input type="text" name="email" />
            <label>Права админа</label><input type="checkbox" name="isAdmin" />
            <input type="submit" name="edit" value="Изменить" />
        </form>
        <?
    }

    public function show($data)
    {
        if(isset($_SESSION['id'])){
            $this->listUsers($data['listUsers']);
            $this->addUser();
            if(isset($_GET['edit'])) {
                $this->editUser($data{'editUserId'});
            }
        }
    }

    public function __construct($data = '')
    {
        $this->show($data);
    }
}