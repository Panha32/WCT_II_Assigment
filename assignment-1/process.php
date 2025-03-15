<?php
$name = $email = $password = $confirm_password = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["name"]))) {
        $errors['name'] = "Name is required";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    if (empty(trim($_POST["email"]))) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    if (empty(trim($_POST["password"]))) {
        $errors['password'] = "Password is required";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $errors['password'] = "Password must be at least 8 characters long";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $errors['confirm_password'] = "Please confirm your password";
    } elseif ($_POST["confirm_password"] != $password) {
        $errors['confirm_password'] = "Passwords do not match";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
    }

    if (empty($errors)) {
        echo "<h2>Registration Successful!</h2>";
        echo "<p>Name: " . $name . "</p>";
        echo "<p>Email: " . $email . "</p>";
    } else {
        echo "<h2>Errors:</h2>";
        foreach ($errors as $field => $error) {
            echo "<p>" . htmlspecialchars($error) . "</p>";
        }
        echo '<a href="registration_form.html">Go back to the form</a>';
    }
}
?>
