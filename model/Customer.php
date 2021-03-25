<?php


class Customer
{
    private int $ID;
    private string $fName;
    private string $lName;
    private int $groupID;
    private int $fixedDisc;
    private int $varDisc;

    public function __construct(int $ID, string $fName, string $lName, int $groupID, int $fixedDisc, int $varDisc)
    {
        $this->fName     = $fName;
        $this->lName     = $lName;
        $this->ID        = $ID;
        $this->groupID   = $groupID;
        $this->varDisc   = $varDisc;
        $this->fixedDisc = $fixedDisc;
    }

    public function getFName(): string
    {
        return $this->fName;
    }

    public function getLName(): string
    {
        return $this->lName;
    }
    public function getName(): string
    {
        return $this->getFName()." ".$this->getLName();
    }

    public function getID(): int
    {
        return $this->ID;
    }

    public function getGroupID(): int
    {
        return $this->groupID;
    }

    public function getVarDisc(): int
    {
        return $this->varDisc;
    }

    public function getFixedDisc(): int
    {
        return $this->fixedDisc;
    }

}