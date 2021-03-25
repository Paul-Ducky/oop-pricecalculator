<?php
declare(strict_types=1);

class Customer
{

    private string $fName;
    private string $lName;
    private int $ID;
    private ?int $groupID;
    private ?int $varDisc;
    private ?int $fixedDisc;

    public function __construct(string $fName, string $lName, int $ID, ?int $groupID, ?int $varDisc, ?int $fixedDisc)
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