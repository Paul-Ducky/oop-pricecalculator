<?php

//@todo gezamelijk bekijken (kern van project)
class Calculator
{
    public const PENNY_CORRECTOR = 100;

    public function GroupDisc(array $groupChain): array
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
            'varDisc' => $maxVarDisc,   //58 -> percentage
            'fixDisc' => $sumFixDisc    //1 -> plat
        ];
        return $calcArray;
    }

    function bestGroupDisc(array $calcArray, float $productPrice): bool|string
    {

        $groupVarDisc = (($productPrice / self::PENNY_CORRECTOR) * ((float)$calcArray['varDisc'] / self::PENNY_CORRECTOR));//used penny_corrector because percentile also uses 100.
        $groupFixDisc = (($productPrice / self::PENNY_CORRECTOR) - $calcArray['fixDisc']); // kans op negatief

        if ($groupFixDisc < 0) {
            $freemsg = 'free';
            return $freemsg;
        }

        if ($groupVarDisc > $groupFixDisc) {
            return true;
        }
        if ($groupVarDisc < $groupFixDisc) {
            return false;
        }
        return false;
    }

    function doTheMaths(customer $customer, bool|string $bool, array $calcArray, $productPrice)
    {
        $truePrice = $productPrice / self::PENNY_CORRECTOR;

        if ($bool && ($customer->getVarDisc() !== null))  // in case both customer and group have varDisc! --> onmogelijk negatief
        {
            // percentage vergelijken met klant
            $bestVarDisc = max($calcArray['varDisc'], $customer->getVarDisc());
            $discount = $truePrice * ($bestVarDisc / self::PENNY_CORRECTOR);
            $priceToPay = $truePrice - $discount;

        }
        if (!$bool && ($customer->getVarDisc() === null)) {  // hoge kans op negatief
            // fixed bij de klant meetellen.
            $discount = $customer->getFixedDisc() + $calcArray['fixDisc'];
            $priceToPay = $truePrice - $discount;
            if($priceToPay<0)
            {
                $priceToPay = 0;
            }
        }
        if (!$bool && ($customer->getVarDisc() !== null)) { // kans op negatief
            // eerste fixed van groep en dan percentage van klant  // 100 //  fix =5 // var 10%
            $varDiscount = ($truePrice - $calcArray['fixDisc']) * ($customer->getVarDisc() / self::PENNY_CORRECTOR);
            $priceToPay = $truePrice - $varDiscount - $calcArray['fixDisc'];
            if($priceToPay<0)
            {
                $priceToPay = 0;
            }

        }
        if ($bool && ($customer->getVarDisc() === null)) { // kans op negatief
            // eerste fixed van klant en dan percentage van groep  // 100 //  fix =5 // var 10%
            $varDiscount = ($truePrice - $customer->getFixedDisc()) * ($calcArray['varDisc'] / self::PENNY_CORRECTOR);
            $priceToPay = $truePrice - $varDiscount - $customer->getFixedDisc();
            if($priceToPay<0)
            {
             $priceToPay = 0;
            }
        }
        if (!is_bool($bool)) { // ingeval dat product  negatieve prijs heeft
            $priceToPay = 0;
        }
        return $priceToPay;
    }
}

