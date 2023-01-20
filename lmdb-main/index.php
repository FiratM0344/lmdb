<?php
session_start();
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->loterij->user;
$user = $_SESSION["user"];
$username = $_SESSION["username"];
if ($user != 1) {
    header("location: loginform.php");
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loterij</title>
</head>
<body>
    <h1>Welkom <?php echo $username; ?></h1>
    <form action="check.php" method="post">
        <select name="test" id="">
    <?php
    $result = $collection->find(["username" => $username]);
    foreach ($result as $dc) {
        foreach ($dc["ticket"] as $tickets) {
            echo $tickets . "<option value=".$tickets."> $tickets </option><br>";
        }
    }
    ?>
    </select>
    <input type="submit" value="submit" name="submit">
    </form>
    <a href="getticket.php">klik hier om een ticket te krijgen (€10)</a><br>
    <a href="profile.php">profiel</a><br>
    <a href="logout.php">uitloggen</a>
</body>
</html>