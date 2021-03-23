<?php
declare(strict_types=1);

class Product
{
    private int $productID;
    private string $productName;
    private int $productPrice;

    public function __construct($productID, $productName, $productPrice)
    {
        $this->productID = $productID;
        $this->productName = $productName;
        $this->productPrice = $productPrice;
    }

    public function getProductID(): int
    {
        return $this->productID;
    }

    public function setProductID(int $productID): void
    {
        $this->productID = $productID;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    public function getProductPrice(): int
    {
        return $this->productPrice;
    }

    public function setProductPrice(int $productPrice): void
    {
        $this->productPrice = $productPrice;
    }

}