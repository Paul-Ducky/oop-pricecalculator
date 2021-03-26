<?php
declare(strict_types=1);

class CustomerLoader
{

    private PDO $conn;
    private array $customerArray;

    public function __construct(){
        $DB = new Db();
        $this->conn = $DB->connect();
    }

    public function getCustomer($customerID){

        $stmt = $this->conn->prepare("SELECT * from customer WHERE id = :ID;");
        $stmt->bindValue('ID', $customerID);
        $stmt->execute();
        $result = $stmt->fetch();
        return new Customer($result['firstname'],$result['lastname'], (int)$result['id'],(int)$result['group_id'],(int)$result['variable_discount'],
            (int)$result['fixed_discount'],$result['username'], $result['password']);
    }

    public function getAllCustomers(): ?array
    {
        {
            $stmt = $this->conn->prepare("SELECT * from customer");
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach($results as $result) {
                $customer = new Customer($result['firstname'],$result['lastname'],(int)$result['id'],(int)$result['group_id'],
                    (int)$result['variable_discount'],(int)$result['fixed_discount'],$result['username'], $result['password']);
                $this->customerArray[] = $customer;
            }
            return $this->customerArray;
        }
    }

    public function getCustomerFromUsername($username): Customer|bool
    {
        $stmt = $this->conn->prepare("SELECT * from customer WHERE username = :username;");
        $stmt->bindValue('username', $username);
        //$stmt->execute();
        if (!$stmt->execute()){
            return false;
        } else {
            $result = $stmt->fetch();
            return new Customer($result['firstname'],$result['lastname'], (int)$result['id'],(int)$result['group_id'],
                (int)$result['variable_discount'], (int)$result['fixed_discount'],$result['username'], $result['password']);
        }

    }

}