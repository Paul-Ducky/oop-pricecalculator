<?php
declare(strict_types=1);

class CustomerGroupLoader
{
    private PDO $conn;
    private array $groupArray = [];

    public function __construct()
    {
        $DB = new Db();
        $this->conn = $DB->connect();
    }

    public function getCustomerGroup(int $groupID): CustomerGroup
    {
        $stmt = $this->conn->prepare("SELECT id, name, parent_id, fixed_discount, variable_discount FROM customer_group WHERE id = :groupID");
        $stmt->bindValue('groupID', $groupID);
        $stmt->execute();
        $result = $stmt->fetch();
        $pid = null;
        if (!is_null($result['parent_id'])) {
            $pid = (int)$result['parent_id'];
        }
        $group = new CustomerGroup((int)$result['id'], $result['name'], $pid, (int)$result['fixed_discount'], (int)$result['variable_discount']);

        return $group;
    }

    public function getGroupChain(CustomerGroup $customerGroup): array
    {

        if ($customerGroup->getParentID() !== null) {
            $stmt = $this->conn->prepare("SELECT id, name, parent_id, fixed_discount, variable_discount FROM customer_group WHERE id = :parentID");
            $stmt->bindValue('parentID', $customerGroup->getParentID());
            $stmt->execute();
            $result = $stmt->fetch();
            $pid = null;
            if (!is_null($result['parent_id'])) {
                $pid = (int)$result['parent_id'];
            }
            $group = new CustomerGroup((int)$result['id'], $result['name'], $pid, (int)$result['fixed_discount'], (int)$result['variable_discount']);
            $this->groupArray[] = $group;
            $this->getGroupChain($group);
        }
        return $this->groupArray;
    }
}
