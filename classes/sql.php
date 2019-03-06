<?php

class sql
{
    private static $host = '';
    private static $user = '';
    private static $pass = '';
    private static $db = '';
    private static $charset = '';


    private static function connectSql($debug = true)
    {

        if ($debug == true) {
            self::$host = 'localhost';
            self::$user = 'root';
            self::$pass = '';
            self::$db = 'adminpanel';
            self::$charset = 'utf8';
        }
        $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$db . ';charset=' . self::$charset;
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdo = new PDO($dsn, self::$user, self::$pass, $opt);
        return $pdo;

    }

    public static function firstRun()
    {
        $pdo = self::connectSql();
        $pdo->query('CREATE TABLE IF NOT EXISTS `users` (
                              `id` int(11) NOT NULL auto_increment,   
                              `login` varchar(70) NOT NULL,       
                              `pass` varchar(255)  NOT NULL,     
                              `email`  varchar (70) NOT NULL,     
                              `isAdmin` varchar(5) NOT NULL default false,
                               PRIMARY KEY  (`id`)
                                );');

        $pdo = null;
    }

    private static function prepareParams($data)
    {
        $stringQuery = '';
        $count = count($data);
        $i = 0;
        foreach ($data as $key => $value) {
            $i++;
            if ($count == $i) {
                $stringQuery .= "$key=:$key";
            } else {
                $stringQuery .= "$key=:$key, ";
            }
            $query['values'][':' . $key] = $value;
        }
        $query['string'] = $stringQuery;

        return $query;
    }
    public static function getTable($table){
        $pdo = self::connectSql();
        $sth = $pdo->query("SELECT * FROM `$table`");
        $array = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

    public static function getString($table, array $params)
    {
        $query = self::prepareParams($params);
        $pdo = self::connectSql();
        $sth = $pdo->prepare("SELECT * FROM `$table` WHERE " . $query['string']);
        $sth->execute($query['values']);
        $array = $sth->fetch(PDO::FETCH_ASSOC);

        return $array;
    }


    public static function addString($table, array $data)
    {
        $query = self::prepareParams($data);

        $pdo = self::connectSql();
        $sth = $pdo->prepare("INSERT INTO `$table` SET " . $query['string']);
        $sth->execute($query['values']);

        return $insert_id = $pdo->lastInsertId();
    }


    public static function deleteStrings($table, $arrId)
    {
        $arrId = implode(', ', $arrId);
        //var_dump($arrId);

        $pdo = self::connectSql();
        $sth = $pdo->query("DELETE FROM `$table` WHERE id IN ($arrId)");
    }

    public static function updateString($table, $id, array $data)
    {
        $query = self::prepareParams($data);
        print_r($query['string']);
        $pdo = self::connectSql();
        $sth = $pdo->prepare("UPDATE `$table` SET " . $query['string'] . ' WHERE `id` = :id');
        $query['values'][':id'] = $id;
        $sth->execute($query['values']);
        $array = $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function __construct()
    {

    }
}