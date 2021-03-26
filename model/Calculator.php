<?php
declare(strict_types=1);
use JetBrains\PhpStorm\ArrayShape;

class Calculator
{
    public const DIVIDER = 100;

    #[ArrayShape(['varDisc' => "int", 'fixDisc' => "int"])] public function GroupDisc(array $groupChain): array
    {
        $sumFixDisc = 0;
        $maxVarDisc = 0;
        foreach ($groupChain as $group) {
            if ($group->getFixedDisc() !== null) {
                $sumFixDisc += $group->getFixedDisc();
            }
            if ($group->getVarDisc() !== null && $group->getVarDisc() > $maxVarDisc) {
                $maxVarDisc = $group->getVarDisc();
            }
        }
        return [
            'varDisc' => $maxVarDisc,     // 30
            'fixDisc' => $sumFixDisc      // 12
        ];
    }

    public function bestGroupDisc(array $calcArray, float $productPrice): bool
    {
        $truePrice = $productPrice / self::DIVIDER;
        $groupVarDisc = ($truePrice * ((float)$calcArray['varDisc'] / self::DIVIDER));
        $groupFixDisc = $calcArray['fixDisc'];
        // kijken welke een groter korting geeft. dan die korting aanhouden bij verdere berekening.

        if ($groupVarDisc > $groupFixDisc) {
            return true;
        }
        if ($groupVarDisc < $groupFixDisc) {
            return false;
        }
        return false;
    }

    public function doTheMaths(customer $customer, bool $bool, array $calcArray, $productPrice)
    {
        $truePrice = $productPrice / self::DIVIDER;
        $priceToPay = 0;

        if ($bool && ($customer->getVarDisc() !== 0)) {
            // percentage vergelijken met klant
            $bestVarDisc = max($calcArray['varDisc'], $customer->getVarDisc());
            $discount = $truePrice * ($bestVarDisc / self::DIVIDER);
            $priceToPay = $truePrice - $discount;
        }
        if (!$bool && ($customer->getFixedDisc() !== 0)) {
            // fixed bij de klant meetellen.
            $discount = $customer->getFixedDisc() + $calcArray['fixDisc'];
            $priceToPay = $truePrice - $discount;
        }
        if (!$bool && ($customer->getVarDisc() !== 0)) {
            // eerste fixed van groep en dan percentage van klant
            $varDiscount = ($truePrice - $calcArray['fixDisc']) * ($customer->getVarDisc() / self::DIVIDER);
            $priceToPay = $truePrice - $varDiscount - $calcArray['fixDisc'];
        }
        if ($bool && ($customer->getFixedDisc() !== 0)) {
            // eerste fixed van klant en dan percentage van groep
            $varDiscount = ($truePrice - $customer->getFixedDisc()) * ($calcArray['varDisc'] / self::DIVIDER);
            $priceToPay = $truePrice - $varDiscount - $customer->getFixedDisc();
        }
        if ($priceToPay < 0) {
            $priceToPay = 0;
        }
        return $priceToPay;
    }
}