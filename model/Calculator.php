<?php
declare(strict_types=1);

use JetBrains\PhpStorm\ArrayShape;


class Calculator
{
    public const PENNY_CORRECTOR = 100;

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
        $calcArray = [
            'varDisc' => $maxVarDisc,     // 30
            'fixDisc' => $sumFixDisc      // 12
        ];
        return $calcArray;
    }

    public function bestGroupDisc(array $calcArray, float $productPrice): bool
    {
        $truePrice = $productPrice / self::PENNY_CORRECTOR;
        $groupVarDisc = ($truePrice * ((float)$calcArray['varDisc'] / self::PENNY_CORRECTOR));//used penny_corrector because percentile also uses 100.
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
        $truePrice = $productPrice / self::PENNY_CORRECTOR;
        $priceToPay = 0;

        if ($bool && ($customer->getVarDisc() !== 0))  // in case both customer and group have varDisc! --> onmogelijk negatief
        {
            // percentage vergelijken met klant
            $bestVarDisc = max($calcArray['varDisc'], $customer->getVarDisc());
            $discount = $truePrice * ($bestVarDisc / self::PENNY_CORRECTOR);
            $priceToPay = $truePrice - $discount;
        }
        if (!$bool && ($customer->getFixedDisc() !== 0)) {  // hoge kans op negatief
            // fixed bij de klant meetellen.
            $discount = $customer->getFixedDisc() + $calcArray['fixDisc'];
            $priceToPay = $truePrice - $discount;

        }
        if (!$bool && ($customer->getVarDisc() !== 0)) { // kans op negatief
            // eerste fixed van groep en dan percentage van klant  // 100 //  fix =5 // var 10%
            $varDiscount = ($truePrice - $calcArray['fixDisc']) * ($customer->getVarDisc() / self::PENNY_CORRECTOR);
            $priceToPay = $truePrice - $varDiscount - $calcArray['fixDisc'];

        }
        if ($bool && ($customer->getFixedDisc() !== 0)) { // kans op negatief
            // eerste fixed van klant en dan percentage van groep  // 100 //  fix =5 // var 10%
            $varDiscount = ($truePrice - $customer->getFixedDisc()) * ($calcArray['varDisc'] / self::PENNY_CORRECTOR);
            $priceToPay = $truePrice - $varDiscount - $customer->getFixedDisc();

        }
        if ($priceToPay < 0) {
            $priceToPay = 0;
        }
        return $priceToPay;
    }
}