<?php
session_start();
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->loterij->user;
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel</title>
</head>
<body>
    <h1>gegevens</h1><hr>
    <p>Gebruikersnaam: <?php echo $username ?></p><br>
    <p>Tickets: <?php 
        $result = $collection->find(["username" => $username]);
        foreach ($result as $dc) {
            foreach ($dc["ticket"] as $tickets) {
                echo $tickets. " , ";
            }
            echo "<br>"."<br>"."<br>";
            echo "balans: €". $dc["balance"];
        }
    ?></p><br>
    <a href="index.php">Home</a><br><br><br><br>
    <a href="deleteUser.php">Account verwijderen</a>
</body>
</html>