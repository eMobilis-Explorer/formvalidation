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
    <title>Form Validation</title>
</head>

<body>

    <?php

    $nameErr = $emailErr = $passwordErr = $passwordRepeatErr = "";
    $name = $email = $password = $passwordRepeat = "";

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

    function yourData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Form Validation</h2>
            <label for="name">

                Username <input type="text" name="name" value="<?php echo $name; ?>">
                <span><?php echo $nameErr; ?></span>
            </label>
            <label for="email">
                Email <input type="email" name="email" value="<?php echo $email; ?>">
                <span><?php echo $emailErr; ?></span>
            </label>
            <label for="password">
                Password <input type="password" name="password" value="<?php echo $password; ?>">
                <span><?php echo $passwordErr; ?></span>
            </label>
            <label for="password_repeat">
                Repeat Password <input type="password" name="password_repeat" value="<?php echo $passwordRepeat; ?>">
                <span> <?php echo $passwordRepeatErr; ?></span>
            </label>

            <button type="submit">Validate</button>


        </form>



        <!-- // if ($nameErr = "" && $emailErr = "") {
        // echo "<p>Hurray all your details are valid </p>";
        // } -->


    </div>

</body>

</html>