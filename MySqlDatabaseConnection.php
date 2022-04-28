<?php

include "DatabaseConnectionInterface.php";

class MySqlDatabaseConnection implements DatabaseConnectionInterface
{

    private static $pdo;

    public static $instanse = null;

    private function __construct(){}

    public static function getInstance()
    {
        if (self::$instanse === null) {
            return self::$instanse = new MySqlDatabaseConnection();
        }else {
            return self::$instanse; 
        }
    }


    public function getConnection(string $host, string $user, string $password, string $dbname) : PDO
    {
        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
        self::$pdo = new PDO($dsn, $user, $password);
        self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return self::$pdo;
    }

}

$connect = MySqlDatabaseConnection::getInstance();
$pdo1 = $connect->getConnection('localhost', 'root', '', 'reza');
$stmt = $pdo1->prepare('SELECT * FROM test');
$stmt->execute();
$result = $stmt->fetchAll();

print_r($result);
