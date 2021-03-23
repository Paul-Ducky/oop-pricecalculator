<?php

//@todo meer pages later?
class controller
{
        public function render(array $_GET, array $_POST){
            require 'view/dropdownForm.php';
            if(isset($_POST['calculate'])){
                require 'view/calcResult.php';
            }
            require 'view/includes/footer.php';
        }

}