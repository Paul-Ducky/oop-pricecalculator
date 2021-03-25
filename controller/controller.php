<?php
declare(strict_types=1);

//@todo login
use JetBrains\PhpStorm\ArrayShape;

class controller
{
    public function render(array $GET, array $POST): void
    {
        $cl = new CustomerLoader();
        $pl = new ProductLoader();
        $customers = $cl->getAllCustomers();
        $products = $pl->getAllProducts();
        require 'view/dropdownForm.php';


        if (isset($_POST['calculate'])) {
            $product = $pl->getProduct((int)$_POST['productID']);
            $customer = $cl->getCustomer($_POST['customerID']);
            $priceToPay = $this->calcPriceToPay($this->prepForCalculation($product, $customer));

            require 'view/calcResult.php';
        }
        require 'view/includes/footer.php';
    }

    #[ArrayShape(['groupChain' => "array", 'productPrice' => "float", 'customer' => \Customer::class])]
    private function prepForCalculation(Product $product, Customer $customer): array
    {
        $productPrice = $product->getProductPrice();
        $cgl = new CustomerGroupLoader();
        $group = $cgl->getCustomerGroup($customer->getGroupID());
        $groupChain = $cgl->getGroupChain($group);
        return ['groupChain' => $groupChain, 'productPrice' => $productPrice, 'customer' => $customer];
    }

    private function calcPriceToPay(array $array): float
    {
        $calc = new Calculator();
        $calcArray = $calc->GroupDisc($array['groupChain']);
        $bool = $calc->bestGroupDisc($calcArray, $array['productPrice']);
        return $calc->doTheMaths($array['customer'], $bool, $calcArray, $array['productPrice']);
    }

}