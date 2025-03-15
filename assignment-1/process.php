<?php
$name = $email = $password = $confirm_password = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the name
    if (empty(trim($_POST["name"]))) {
        $errors['name'] = "Name cannot be empty.";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    if (empty(trim($_POST["email"]))) {
        $errors['email'] = "Email cannot be empty.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    if (empty(trim($_POST["password"]))) {
        $errors['password'] = "Password cannot be empty.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $errors['password'] = "Password must be at least 6 characters long.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $errors['confirm_password'] = "Please confirm your password.";
    } elseif ($_POST["confirm_password"] != $password) {
        $errors['confirm_password'] = "Passwords do not match.";
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
