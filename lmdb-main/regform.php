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
    <title>Register</title>
</head>
<body>


    <form method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="password1" placeholder="password">
        <input type="text" name="password2" placeholder="repeat password">
        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>


<?php
if (isset($_POST["submit"])) {
    session_start();
    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->loterij->user;
    $username = $_POST["username"];
    $password = $_POST["password1"];
    $password2 = $_POST["password2"];  
    if ($password != $password2) {
        header("location: regform.php");
    }  else {
        $result = $collection->insertOne(["username" => $username, "password" => $password, "balance" => 50, "ticket" => []]);
        header("location: loginform.php");
        }
    };
?>