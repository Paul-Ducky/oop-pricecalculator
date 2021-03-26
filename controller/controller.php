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
        $msg = "";
        $customers = $cl->getAllCustomers();
        $products = $pl->getAllProducts();

        if (!isset($_GET['page']) && !isset($_SESSION['customerID'])){
            require 'view/loginForm.php';
        }

        if (isset($_GET['page']) && $_GET['page'] === 'logout'){
            //header('index.php');
            session_destroy();
            unset($_SESSION['customerID']);
            require 'view/loginForm.php';
        }

        if (isset($_GET['page']) && $_GET['page'] === 'login'){
            require 'view/loginForm.php';
        }


        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($cl->getCustomerFromUsername($username) === false) {
                $msg = "Username or password incorrect, please try again";
                require 'view/loginForm.php';
                exit;
            } else {
                $customer = $cl->getCustomerFromUsername($username);
            }
            if ($customer->getUsername() === $username && $customer->getPassword() === $password) {
                $msg = "Welcome, " . $customer->getFName() . " " . $customer->getLName();
                $_SESSION['customerID'] = $customer->getID();
                require 'view/login.php';
            } else {
                $msg = "Username or password incorrect, please try again";
                require 'view/loginForm.php';
            }
        } else if (isset($_SESSION['customerID'])) {
            var_dump($_SESSION['customerID']);
            require 'view/login.php';
        }


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
        array_unshift($groupChain, $group);
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