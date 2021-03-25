<?php declare(strict_types=1);

require 'includes/header.php'

?>

<div class="container">
    <h3><?php echo $msg ?></h3>
    <h2>Select the product</h2>
    <form method="post" class="form-inline">

        <div class="form-group">
            <label for="sel1">Select product: </label>
            <select name="productID" class="form-control col-8" id="sel1">
                <?php foreach($products AS $product):?>
                    <option value="<?php echo $product->getProductID();?>"> <?php echo $product->getProductName(); ?> </option>
                <?php endforeach;?>
            </select>
        </div>

        <button type="submit" name="calculate" class="btn btn-primary" id="submit">Submit</button>
    </form>
</div>
