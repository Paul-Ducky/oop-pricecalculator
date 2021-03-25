<?php

declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'model/Db.php';
require 'model/Calculator.php';
require 'model/Customer.php';
require 'model/CustomerGroup.php';
require 'model/Product.php';

require 'loader/CustomerGroupLoader.php';
require 'loader/CustomerLoader.php';
require 'loader/ProductLoader.php';

require 'controller/controller.php';


$controller = new controller();
$controller->render($_GET, $_POST);