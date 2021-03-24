<?php


class Db
{

    private const HOST = "localhost";
    private string $user = "root";
    private string $pwd = "";
    private string $dbName = "oop_calc";

    public function connect() : PDO
    {
        $dsn = 'mysql:host=' . self::HOST . ';dbname=' . $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }

}