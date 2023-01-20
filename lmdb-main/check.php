<?php
session_start();
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->loterij->user;
$username = $_SESSION["username"];
$ticket = $_POST["test"];
$ticket = intval($ticket);
var_dump($ticket);
$random = rand(0,2);
$check = $ticket+$random;
echo $username;
echo "<br>";
if ($ticket == $check) {
    $price = rand(50, 200);
    $result = $collection->updateOne(["username" => $username],['$pull' => ["ticket" => ['$in' => [$ticket]]]]);
    $dbBalance = $collection->find(["username" => $username], ["balance"]);
    foreach ($dbBalance as $dc) {
    };
    $test = $dc["balance"]+$price;
    echo "werkt";
    $newBalance = $collection->updateOne(["username" => $username], ['$set'=>["balance" => $test]]);
    echo "test";
    echo '<script>alert("gefeliciteerd! U heeft gewonnen! de ticket had een waarde van: €'.$price.' Uw balans is nu €'.$test.'");window.location.href="index.php";</script>';
} else {
    $result = $collection->findOne(["username" => $username]);
    $result = $collection->updateOne(["username" => $username],['$pull' => ["ticket" => ['$in' => [$ticket]]]]);
    echo '<script>alert("Helaas. U heeft niet gewonnen");window.location.href="index.php";</script>';
}
?>
