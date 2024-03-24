<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Example</title>
</head>

<body>
    <form action="sessionCompleteExample.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="login">Login</button>
    </form>

    <form action="sessionCompleteExample.php" method="post">
        <input type="hidden" name="logout" value="1">
        <button type="submit">Logout</button>
    </form>
</body>

</html>


<?php

session_start();

$dummy_username = "Ali";
$dummy_password = "password";

// Check for a login cookie
if (isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    echo "Welcome back, " . $_SESSION["username"] . ".<br>";
}

// User login attempt
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $dummy_username && $password === $dummy_password) {
        $_SESSION['username'] = $username;

        // Set a cookie for the username, expires after 1 hour
        setcookie('username', $username, time() + (3600), "/");

        echo "Logged in as " . $_SESSION["username"] . ".";
    } else {
        echo "Invalid username or password.";
    }
}

// Log out
if (isset($_POST['logout'])) {
    // Clear the session
    session_unset();
    session_destroy();

    // Clear the cookie
    setcookie('username', '', time() - 3600, "/");

    echo "<br>" . "You have been logged out.";
}

?>