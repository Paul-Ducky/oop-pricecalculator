<?php


class CustomerGroupLoader
{
    private PDO $conn;

    public function __construct(){
        $DB = new Db();
        $this->conn = $DB->connect();
    }
}