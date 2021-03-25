<?php declare(strict_types=1);require 'includes/header.php'; ?>
    <div class="container">
        <h2>Select the product, and customer!</h2>
        <form method="post" class="form-inline">
            <div class="form-group">
                <label for="sel1">Select product: </label>
                <select name="productID" class="form-control col-8" id="sel1">
                    <?php foreach($products AS $product):?>
                        <option value="<?php echo $product->getProductID();?>"> <?php echo $product->getProductName(); ?> </option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="sel2">Select customer: </label>
                <select name="customerID" class="form-control col-8" id="sel2">
                    <?php foreach($customers AS $customer):?>
                        <option value="<?php echo $customer->getID();?>"> <?php echo $customer->getName(); ?> </option>
                    <?php endforeach;?>
                </select>
            </div>
            <button type="submit" name="calculate" class="btn btn-primary" id="submit">Submit</button>
        </form>
    </div>
