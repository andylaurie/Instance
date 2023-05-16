<?php
    include("includes/init.php");

    $account = new Account();

    include("includes/handlers/login-controller.php");

    function getInputValue($name)
    {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<html>
    <head>
        <title>Instance</title>
        <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    </head>
    <body>

        <div class="loginBaseContainer">
            <div class="loginFormContainer">

                <form id="loginForm" action="login.php" method="POST">
                    <h3>
                        <img
                            id="loginLogo"
                            src="assets/images/logo/Instance-Logo-BLUE-png3.png">
                    </h3>
                    <p>
                        <input id="loginUsername" name="loginUsername"
                            type="text" placeholder="Username"
                            value="<?php getInputValue('loginUsername'); ?>"
                            required>
                    </p>
                    <p>
                        <input id="loginPassword" name="loginPassword"
                            type="password" placeholder="Password" required>
                    </p>
                    <button type="submit" name="loginButton">Log in</button>
                    <p class="loginError">
                        <?php
                            echo $account->getError(Constants::LOGIN_FAILED);
                        ?>
                    </p>
                </form>

            </div>
        </div>

    </body>
</html>
