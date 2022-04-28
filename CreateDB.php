<?php

class CreateDB {

    private $pdo;

    public function __construct(string $host, string $user, string|int $password, string $dbName)
    {
        $pdo = new PDO($host, $user, $password);
        $stmt = $pdo->prepare('CREATE DATABASE IF NOT EXISTS ?');
        $stmt->execute([$dbName]);
        $this->pdo = $pdo; 
    }

    public function __destruct()
    {
        unset($this->pdo);
    }
}