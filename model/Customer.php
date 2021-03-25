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
    private string $username;
    private string $password;

    public function __construct(string $fName, string $lName, int $ID, ?int $groupID, ?int $varDisc, ?int $fixedDisc, string $username, string $password)
    {
        $this->fName     = $fName;
        $this->lName     = $lName;
        $this->ID        = $ID;
        $this->groupID   = $groupID;
        $this->varDisc   = $varDisc;
        $this->fixedDisc = $fixedDisc;
        $this->username = $username;
        $this->password = $password;
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

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }



}