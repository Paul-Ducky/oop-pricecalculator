<?php

//@todo meer pages later?
class controller
{
        public function render(array $GET, array $POST): void
        {
            $cl = new CustomerLoader();
            $pl = new ProductLoader();
            $customers = $cl->getAllCustomers();
            $products = $pl->getAllProducts();
            require 'view/dropdownForm.php';




            if(isset($_POST['calculate']))
            {
                $product = $pl->getProduct($_POST['productID']);
                $productPrice = $product->getProductPrice();
                $customer = $cl->getCustomer($_POST['customerID']);
                $cgl = new CustomerGroupLoader();
                $group = $cgl->getCustomerGroup($customer->getGroupID());
                $groupChain = $cgl->getGroupChain($group);
                array_unshift($groupChain,$group);
                // alle info over product en klant(groep) is gereed.
                // nu de calculator
                $calc = new Calculator();
                $calcArray = $calc->GroupDisc($groupChain);
                $bool = $calc->bestGroupDisc($calcArray,$productPrice);
                $priceToPay = $calc->doTheMaths($customer,$bool,$calcArray,$productPrice);

                require 'view/calcResult.php';

            }
            require 'view/includes/footer.php';
        }

}