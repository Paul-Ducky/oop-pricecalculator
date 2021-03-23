<?php

//@todo gezamelijk bekijken (ingewikkeld?)
class CustomerGroupLoader
{
    private PDO $conn;

    public function __construct()
    {
        $DB = new Db();
        $this->conn = $DB->connect();
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
}