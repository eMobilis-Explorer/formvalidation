<?php

if (isset($_POST['email']) && isset($_POST['password'])) {
    // CHECK IF FIELDS ARE NOT EMPTY
    // if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
    // Escape special characters.
    // $username = mysqli_real_escape_string($connection, htmlspecialchars($_POST['name']));
    $user_email = mysqli_real_escape_string($connection, htmlspecialchars($_POST['email']));

    $query = mysqli_query($connection, "SELECT * FROM `users` WHERE user_email = '$user_email'");
    // $query2 = mysqli_query($connection, "SELECT * FROM `users` WHERE ");
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $user_db_pass = $row['user_password'];

        // VERIFY PASSWORD
        $check_password = password_verify($_POST['password'], $user_db_pass);

        if ($check_password === true) {
            session_regenerate_id(true);

            $_SESSION['email'] = $user_email;
            // $_SESSION['name'] = $username;

            header('Location: valid.php');
            exit;
        } else {
            // INCORRECT PASSWORD
            $error_message = "Incorrect Email Address or Password.";
        }
    } else {
        // EMAIL NOT REGISTERED
        $error_message = "Incorrect Email Address or Password.";
    }
} else {
    // IF FIELDS ARE EMPTY
    $error_message = "Please fill in all the required fields.";
}
// }
