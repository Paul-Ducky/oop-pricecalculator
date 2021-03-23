<?php


class CustomerLoader
{
    private PDO $conn;

    public function __construct(){
        $DB = new Db();
        $this->conn = $DB->connect();
    }

    public function getCustomer($customerID){
//@todo nakijken met customer class.
        $stmt = $this->conn->prepare("SELECT id, concat_ws(' ',firstName, lastName )AS name, group_id, variable_discount, fixed_discount as name from customer
                                            WHERE id = :ID;");
        $stmt->bindValue('ID', $customerID);
        $stmt->execute();
        $result = $stmt->fetch();
        $product = new Customer((int)$result['id'], $result['name'], (int)$result['variable_discount'], );

        return $product;
    }
//@todo functie afwerken.
    public function getAllCustomers(){

    }

}