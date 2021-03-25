<?php


class CustomerLoader
{

    private PDO $conn;
    private array $customerArray;

    public function __construct(){
        $DB = new Db();
        $this->conn = $DB->connect();
    }

    public function getCustomer($customerID){

        $stmt = $this->conn->prepare("SELECT id, firstName, lastName , group_id, fixed_discount, variable_discount from customer
                                            WHERE id = :ID;");
        $stmt->bindValue('ID', $customerID);
        $stmt->execute();
        $result = $stmt->fetch();
        return new Customer((int)$result['id'],$result['firstName'],$result['lastName'],$result['group_id'],(int)$result['fixed_discount'],(int)$result['variable_discount']);
    }

    public function getAllCustomers(): ?array
    {
        {
            $stmt = $this->conn->prepare("SELECT id, firstName, lastName , group_id, fixed_discount, variable_discount from customer");
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach($results as $result) {
                $customer = new Customer((int)$result['id'],$result['firstName'],$result['lastName'],$result['group_id'],(int)$result['fixed_discount'],(int)$result['variable_discount']);
                $this->customerArray[] = $customer;
            }
            return $this->customerArray;
        }
    }

}