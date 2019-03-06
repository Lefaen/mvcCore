<?php
//extends getData()
//extends setData()
class listUsersModel extends modelBase
{

    private function valid($fields){
        return $fields;
    }

    private function usersList()
    {
        $user = user::getUser();
        if ($user->getIsAdmin() == 'true') {
            $listUsers = user::getListUsers();

            foreach ($listUsers as &$user) {
                if ($user['isAdmin'] != 'true') {
                    $user['isAdmin'] = 'false';
                }
            }

            return $listUsers;
        }
    }

    private function editUser()
    {
        if (isset($_GET['id']) && isset($_GET['edit'])) {

            $id = (int)$_GET['id'];
            $edit = null;
            if($_GET['edit'] == 'true'){
                $edit = true;
            }elseif($_GET['edit'] == 'false'){
                $edit = false;
            }
            if(user::getUser()->getIsAdmin() == 'true'){
                $editUserId = $_GET['id'];

                return $editUserId;
                //$this->setData($data);
            }
        }
        if(isset($_POST) && isset($_POST['edit'])){
            if(user::getUser()->getIsAdmin() == 'true'){
                $fields = $this->valid($_POST);
                user::editUser($fields);
            }
        }
    }

    private function deleteUsers()
    {
        $arrId = null;
        foreach ($_POST as $key => $value) {
            if (isset($_POST['remove'])) {
                if ($value == 'id') {
                    $arrId[] = $key;
                }
            }
        }
        user::deleteUsers($arrId);
    }

    public
    function __construct()
    {
        $data = null;
        $data['listUsers'] = $this->usersList();
        $data['editUserId'] = $this->editUser();
        $this->deleteUsers();

        $this->setData($data);

    }
}