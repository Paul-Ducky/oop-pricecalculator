<?php require 'includes/header.php';?>
    <div class="container">
        <h2>Select the product, and customer!</h2>
        <form method="post" class="form-inline">
            <div class="form-group">
                <label for="sel1">Select product:</label>
                <select name="product" class="form-control col-6" id="sel1">
                    <option value="1">test</option>
                    <option value="2">test</option>
                    <?php foreach($products AS $product):?>
                        <option value="<?php echo $product->getProductID();?>"><?php echo $product->getProductName(); ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="sel2">Select customer:</label>
                <select name="customer" class="form-control col-6" id="sel2">
                    <option value="1">test</option>
                    <option value="2">test</option>
                    <?php foreach($customers AS $customer):?>
                        <option value="<?php echo $customer->getCustomerID()?>"><?php echo $customer->getFirstName() ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <button type="submit" name="calculate" class="btn btn-primary" id="submit">Submit</button>
        </form>
    </div>
<?php require 'includes/footer.php';?>