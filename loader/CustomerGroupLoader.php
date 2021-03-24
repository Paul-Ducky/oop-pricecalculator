<?php

//@todo gezamelijk bekijken (ingewikkeld?)
class CustomerGroupLoader
{
    private PDO $conn;
    private array $groupArray = [];

    public function __construct()
    {
        $DB = new Db();
        $this->conn = $DB->connect();
    }

    public function getCustomerGroup($groupID): CustomerGroup
    {
        $stmt = $this->conn->prepare("SELECT id, name, parent_id, fixed_discount, variable_discount FROM customer_group WHERE id = :groupID");
        $stmt->bindValue('groupID', $groupID);
        $stmt->execute();
        $result = $stmt->fetch();
        $group = new CustomerGroup((int)$result['id'], $result['name'], (int)$result['parent_id'], (int)$result['fixed_discount'], (int)$result['variable_discount']);

        return $group;
    }

    public function getGroupChain($customerGroup): array
    {
        var_dump($customerGroup->getParentID());
        if($customerGroup->getParentID() !== null){
            $stmt = $this->conn->prepare("SELECT id, name, parent_id, fixed_discount, variable_discount FROM customer_group WHERE id = :parentID");
            $stmt->bindValue('parentID', $customerGroup->getParentID());
            $stmt->execute();
            $result = $stmt->fetch();
            $group = new CustomerGroup((int)$result['id'], $result['name'], (int)$result['parent_id'], (int)$result['fixed_discount'], (int)$result['variable_discount']);
            $this->groupArray[] = $group;
            $this->getGroupChain($group->getParentID());
        }
        var_dump($this->groupArray);
        return $this->groupArray;
    }

}

//   public function getCustomerGroupDiscounts($customerGroupID)
//   {
//       //QUERY
//       $groupArray[] => // if parentID then push to array.
//       //return $groupArray[obj, obj ]
//   }

//               $fixdisc=0;
//               $vardisc = 0;
 //           foreach ($groupArray as $group)
 //           {
 //                   $fixdisc += $group->getfixdisc                           58
 //               if(variable_discount = null){ variable_discount = 0}
 //               if ($vardisc<variable_discount)   0<58         58< 5     5 < null
 //               {
 //                   $vardisc = variable_discount(db);
 //               }
 //           }
  //         return $calcArray[$fixdisc,$vardisc];
