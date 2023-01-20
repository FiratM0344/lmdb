<?php
session_start();
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->loterij->user;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="password" placeholder="password">
        <input type="submit" value="submit" name="submit">
    </form>
    <a href="regform.php">Register</a>
</body>
</html>

<?php
if (isset($_POST["submit"])) {
    session_start();
    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->loterij->user;
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = $collection->find(["username" => $username, "password" => $password]);
    foreach($result as $dc) {
        $dbusername = $dc["username"];
        $dbpassword = $dc["password"];
    };
    if ($password == $dbpassword) {
        echo "wachtwoorden komen overeen";
        $user = 1;
        $_SESSION["user"] = $user;
        $_SESSION["username"] = $dbusername;
        header("location: index.php");
    }   else {
        echo "wachtwoorden komen niet overeen";
        header("location: loginform.php");
    }
}
?>
