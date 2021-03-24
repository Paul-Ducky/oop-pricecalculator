<?php

require 'model/Db.php';
require 'model/Calculator.php';
require 'model/Customer.php';
require 'model/CustomerGroup.php';
require 'model/Product.php';

require 'loader/CustomerGroupLoader.php';
require 'loader/CustomerLoader.php';
require 'loader/ProductLoader.php';

require 'controller/controller.php';


$controller=new controller();
$controller->render($_GET,$_POST);