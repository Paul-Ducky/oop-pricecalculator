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

        $stmt = $this->conn->prepare("SELECT id, firstname, lastname , group_id, variable_discount, fixed_discount from customer
                                            WHERE id = :ID;");
        $stmt->bindValue('ID', $customerID);
        $stmt->execute();
        $result = $stmt->fetch();
        return new Customer($result['firstname'],$result['lastname'], (int)$result['id'],(int)$result['group_id'],(int)$result['variable_discount'], (int)$result['fixed_discount']);
    }

    public function getAllCustomers(): ?array
    {
        {
            $stmt = $this->conn->prepare("SELECT id, firstName, lastName , group_id, variable_discount, fixed_discount from customer");
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach($results as $result) {
                $customer = new Customer($result['firstName'],$result['lastName'],(int)$result['id'], (int)$result['group_id'] ,(int)$result['variable_discount'], (int)$result['fixed_discount']);
                $this->customerArray[] = $customer;
            }
            return $this->customerArray;
        }
    }

}