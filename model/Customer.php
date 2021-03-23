<?php


class Customer
{
//@todo afwerken.
    private string $fName;
    private string $lName;
    private int $ID;
    private int $gID;
    private int $varDisc;
    private int $fixedDisc;

    public function __construct(string $fName, string $lName, int $ID, int $gID)
    {
        $this->fName = $fName;
        $this->lName = $lName;
        $this->ID = $ID;
        $this->gID = $gID;
    }

}