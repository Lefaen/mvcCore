<?php

class user
{
    private static $user;

    const USERS_TABLE = 'users';

    private $login;
    private $pass;
    private $email;
    private $isAdmin;

    public function __construct()
    {
        self::$user = &$this;
    }
    public static function getUser($login = null)
    {
        $userSql = null;
        if(!empty($_SESSION['id'])){
            $userSql = sql::getString(self::USERS_TABLE, array('id' => $_SESSION['id']));

        }else{
            $userSql = sql::getString(self::USERS_TABLE, array('login' => $login));
        }
        self::$user->setUser($userSql['login'], $userSql['pass'], $userSql['email'], $userSql['isAdmin']);
        return self::$user;

    }
    public function setUser($login, $pass, $email, $isAdmin)
    {
        self::$user->setLogin($login);
        self::$user->setPass($pass);
        self::$user->setEmail($email);
        self::$user->setIsAdmin($isAdmin);
    }

    public static function editUser($fields){
        $id = $fields['id'];
        unset($fields['id']);
        unset($fields['edit']);
        foreach ($fields as $Key => $value){
            if(empty($value)){
                unset($fields[$Key]);
            }
        }
        sql::updateString('users', $id, $fields);
    }

    public static function deleteUsers($arrId){
        if(!empty($arrId)){
            sql::deleteStrings('users', $arrId);
        }
    }
    public static function getListUsers(){
        $listUsers = sql::getTable('users');
        return $listUsers;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }
    public function getLogin(){
        return $this->login;
    }
    public function setPass($pass)
    {
        $this->pass = $pass;
    }
    public function getPass(){
        return $this->pass;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }
    public function getIsAdmin(){
        return $this->isAdmin;;
    }

    public function signIn($login, $pass){
        $userSql = sql::getString(self::USERS_TABLE, array('login' => $login));
        if(isset($userSql)){
            if(password_verify($pass, $userSql['pass'])){

                $_SESSION['id'] = $userSql['id'];
            }
        }
    }
    public function signUp($login, $pass, $email)
    {
        $passHash = password_hash($pass, PASSWORD_DEFAULT);

        $data['login'] = $login;
        $data['pass'] = $passHash;
        $data['email'] = $email;

        if(sql::getString(self::USERS_TABLE, array('login' => $data['login'])) == false){
            $latestId = sql::addString(self::USERS_TABLE, $data);
            return $latestId;
        }else{
            return false;
        }

        //sql::getString(self::USERS_TABLE, array('login' => $data['login']));
        //sql::updateString(self::USERS_TABLE, 1, array('email' => $data['email']));
        //sql::removeString(self::USERS_TABLE, 1);

    }
    public function logout(){
        unset($_SESSION['id']);
    }

}

?>