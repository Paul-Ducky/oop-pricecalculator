<?php

declare(strict_types=1);

require 'includes/header.php';

?>

<div class="container">

    <div class="row">
        <div class="col-md-6">
            <h2>Login</h2>
            <form method="post"> <!-- removed action="view/login.php" -->
                <div class="form-group">
                    <label for="username">Username: </label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn-primary"> Login!</button>
            </form>
        </div>
    </div>

</div>

<?php require 'includes/footer.php'; ?>
