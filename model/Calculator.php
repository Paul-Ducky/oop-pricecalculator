<?php

//@todo gezamelijk bekijken (kern van project)
class Calculator
{
            public const PENNY_CORRECTOR = 100;
            private int $varDisc; // beste van individuele var disc.
            private int $fixDisc; // som van individuele fixed disc.
            private int $productPrice; //corrigeren met delen door 100



    function findBestGroupDisc($calcArray, $productprice){

        $groupVarDisc = ($productprice/self::PENNY_CORRECTOR * (int)$calcArray['vardisc']/self::PENNY_CORRECTOR);//used penny_corrector because percentile also uses 100.
        $groupFixDisc = ($productprice/self::PENNY_CORRECTOR) - $calcArray['fixDisc'];

        if($groupVarDisc >= $groupFixDisc ){
            $bestGroupDisc = $groupVarDisc;
        }else
        {
            $bestGroupDisc = $groupFixDisc;
        }
        return $bestGroupDisc;
    }

    function compareDiscounts($customerVarDisc, $groupVarDisc){  // enkel als customer en groep varDisc heeft.
                if($customerVarDisc<$groupVarDisc){
                    $discount = $groupVarDisc;
                }else{
                    $discount = $customerVarDisc;
                }
                return $discount;
    }


    function calcDisc($discount){ // het bedrag dat van het totaal af moet /  neem 100€ als prijs
       //bv sumfixdisc = 7 => prijs -7 = temp
        // vardisc = 10%  => (temp /100) * vardisc
       // totaldisc = sumfixdisc + vardisc
        // return $totaldisc.
    }

    function calcTotal($productprice, $discount){
        // price - discount
    }



    /* calculation notes
     *
     * while (parentID != null)
     * {
     *      $sumFixDisc += $fixDisc;
     *  if ($maxVarDisc < $varDisc)
     * {
     * $maxVarDisc = $varDisc;
     * }
     *}
     *
     */
}