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

            $cgl = new CustomerGroupLoader();
            $group = $cgl->getCustomerGroup(19);
            $groupchain = $cgl->getGroupChain($group);


            if(isset($_POST['calculate']))
            {
                $calculator = new Calculator();
                $product = $pl->getProduct($_POST['productID']);
                $customer = $cl->getCustomer($_POST['customerID']);

                require 'view/calcResult.php';
            }
            require 'view/includes/footer.php';
        }

}