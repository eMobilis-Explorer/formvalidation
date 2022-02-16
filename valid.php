<?php
session_start();
require 'connection.php';
// CHECK USER IF LOGGED IN
if (isset($_SESSION['email']) && !empty($_SESSION['email']) && isset($_SESSION['name']) && !empty($_SESSION['name'])) {
    $user_email = $_SESSION['email'];
    // $username = $_SESSION['name'];
    // AND username = '$username'
    $get_user_data = mysqli_query($connection, "SELECT * FROM `users` WHERE user_email = '$user_email'");
    $userData =  mysqli_fetch_assoc($get_user_data);
} else {
    header('Location: logout.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital@1&family=Quintessential&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Your Details</title>
</head>

<body>
    <div class="valid">
        <?php
        // $name = $userData['username'];
        $email = $userData['user_email'];

        // echo "<p>Hey  <span id='you'>$name</span> 👋🏾</p> ";
        echo "<p>Your email address is <span id='you'>$email</span> I'll be contacting you in a few</p>";
        echo "<p class='signuptext'>Thanks for signing up</p>";
        echo "<a href='logout.php'>Logout</a>"

        ?>

    </div>
</body>

</html>