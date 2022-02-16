
<?php
// require 'validate.php';

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_repeat'])) {
    // CHECK IF FIELDS ARE NOT EMPTY

    // if (!empty(trim($_POST['name'])) && !empty(trim($_POST['email'])) && !empty($_POST['password']) && !empty($_POST['password_repeat'])) {
    // Escape special characters.

    $username = mysqli_real_escape_string($connection, htmlspecialchars($_POST['name']));
    $user_email = mysqli_real_escape_string($connection, htmlspecialchars($_POST['email']));

    //IF EMAIL IS VALID
    // if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
    // CHECK IF EMAIL IS ALREADY REGISTERED
    $check_email = mysqli_query($connection, "SELECT `user_email` FROM `users` WHERE user_email = '$user_email'");

    if (mysqli_num_rows($check_email) > 0) {
        $error_message = "This Email Address is already registered. Please Try another.";
    } else {
        // IF EMAIL IS NOT REGISTERED
        // Check if password matches to the repeat password then hash the password
        /* -- ENCRYPT USER PASSWORD USING PHP password_hash function
                LEARN ABOUT PHP password_hash - http://php.net/manual/en/function.password-hash.php
                -- */

        // $user_hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // $password = $_POST['password'];
        // $passwordRepeat = $_POST['password_repeat'];

        if ($passwordRepeat == $password) {
            $user_hash_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        // INSER USER INTO THE DATABASE
        $insert_user = mysqli_query($connection, "INSERT INTO `users` (username, user_email, user_password) VALUES ('$name', '$user_email', '$user_hash_password')");

        if ($insert_user === true) {
            $success_message = "Thanks! You have successfully signed up.";
        } else {
            $error_message = "Oops! something wrong.";
        }
    }
}
