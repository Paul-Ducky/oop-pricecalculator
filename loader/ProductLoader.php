<?php
declare(strict_types=1);

require_once 'Product.php';
require_once 'Db.php';

class ProductLoader
{
    private array $productArray = [];

    public function getProduct(int $productID): Product
    {
        $DB = new Db();
        $conn = $DB->connect();

        $stmt = $conn->prepare("SELECT id, name, price FROM product WHERE id = :productID");
        $stmt->bindValue('productID', $productID);
        $stmt->execute();
        $result = $stmt->fetch();
        $product = new Product ((int)$result['id'], $result['name'], (int)$result['price']);

        return $product;
    }

    public function getAllProducts(): array
    {
        $DB = new Db();
        $conn = $DB->connect();

        $stmt = $conn->prepare("SELECT id, name, price FROM product");
        $stmt->execute();
        $results = $stmt->fetchAll();
        foreach($results as $result) {
            $product = new Product((int)$result['id'], $result['name'], (int)$result['price']);
            array_push($this->productArray, $product);
        }

        return $this->productArray;
    }
}