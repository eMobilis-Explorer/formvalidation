<?php

session_start();
require 'connection.php';
require 'validate.php';
require 'login.php';
// require 'insert_user.php';
// IF USER LOGGED IN
if (isset($_SESSION['email'])) {
    header('Location: valid.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital@1&family=Quintessential&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>

<body>

    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Sign in</h2>
            <label for="name">

                Username <input type="text" name="name" value="<?php echo $name; ?>">
                <span> <?php echo $nameErr; ?></span>
            </label>
            <label for="email">
                Email <input type="email" name="email" value="<?php echo $email; ?>">
                <span><?php echo $emailErr; ?></span>
            </label>
            <label for="password">
                Password <input type="password" name="password" value="<?php echo $password; ?>">
                <span><?php echo $passwordErr; ?></span>
            </label>
            <!-- <label for="password_repeat">
                Repeat Password <input type="password" name="password_repeat" value="<?php echo $passwordRepeat; ?>">
                <span> <?php echo $passwordRepeatErr; ?></span>
            </label> -->

            <button type="submit" class="login">Login</button>

            <!-- Success or error given -->

            <?php
            if (isset($success_message)) {
                echo '<div class="success_message">' . $success_message . '</div>';
            }
            if (isset($error_message)) {
                echo '<div class="error_message">' . $error_message . '</div>';
            }
            ?>

            <!-- Success or error given -->

            <!-- Create account button to take you to signup.php -->

            <div class="createaccount">
                <a href="signup.php">
                    <button type="button" class="signup">Create an account</button>
                </a>
            </div>

        </form>



        <!-- // if ($nameErr = "" && $emailErr = "") {
        // echo "<p>Hurray all your details are valid </p>";
        // } -->


    </div>

</body>

</html>