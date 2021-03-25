<?php
declare(strict_types=1);

class CustomerGroup
{
    private int $groupID;
    private string $name;
    private ?int $parentID;
    private ?int $fixedDisc;
    private ?int $varDisc;

    public function __construct(int $groupID, string $name, ?int $parentID, ?int $fixedDisc, ?int $varDisc)
    {
        $this->groupID = $groupID;
        $this->name = $name;
        $this->parentID = $parentID;
        $this->fixedDisc = $fixedDisc;
        $this->varDisc = $varDisc;
    }

    public function getGroupID(): int
    {
        return $this->groupID;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParentID(): ?int
    {
        return $this->parentID;
    }

    public function getFixedDisc(): ?int
    {
        return $this->fixedDisc;
    }

    public function getVarDisc(): ?int
    {
        return $this->varDisc;
    }
}