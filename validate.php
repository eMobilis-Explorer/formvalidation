<?php

$nameErr = $emailErr = $passwordErr = $passwordRepeatErr = "";
$name = $email = $password = $passwordRepeat = "";

function yourData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = yourData($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = yourData($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = yourData($_POST["password"]);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $passwordErr = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
        }
    }
    if (empty($_POST["password_repeat"])) {
        $passwordRepeatErr = "Repeat your password";
    } else {
        $passwordRepeat = yourData($_POST["password_repeat"]);
        if ($passwordRepeat != $password) {
            $passwordRepeatErr = "Your passwords do not match, repeat";
        }
    }
}

// if (function_exists('yourData')) {
// }
