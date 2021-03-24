<?php
declare(strict_types=1);

require_once 'model/Product.php';
require_once 'model/Db.php';

class ProductLoader
{
    private array $productArray = [];
    private PDO $conn;

    public function __construct(){
        $DB = new Db();
        $this->conn = $DB->connect();
    }

    public function getProduct(int $productID): Product
    {

        $stmt = $this->conn->prepare("SELECT id, name, price FROM product WHERE id = :productID");
        $stmt->bindValue('productID', $productID);
        $stmt->execute();
        $result = $stmt->fetch();
        $product = new Product ((int)$result['id'], $result['name'], (float)$result['price']);

        return $product;
    }

    public function getAllProducts(): array
    {

        $stmt = $this->conn->prepare("SELECT id, name, price FROM product");
        $stmt->execute();
        $results = $stmt->fetchAll();
        foreach($results as $result) {
            $product = new Product((int)$result['id'], $result['name'], (float)$result['price']);
            array_push($this->productArray, $product);
        }
        return $this->productArray;
    }
}