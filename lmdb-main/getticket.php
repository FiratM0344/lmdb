<?php
session_start();
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->loterij->user;
$username = $_SESSION["username"];
$ticket = rand(1000, 9999); 
$result = $collection->find(["username" => $username], ["balance"]);
foreach ($result as $dc) {
    echo $dc["balance"];
};
if ($dc["balance"] >= 10) {
    $fee = 10;
    $newBal = $dc["balance"]-$fee;
    echo $newBal;
    $result = $collection->updateOne(['username' => $username], ['$push' => ['ticket' => $ticket] ]);
    $payResult = $collection->updateOne(["username" => $username], ['$set' => ["balance" => $newBal]]);
    echo "gelukt";
} else {
    echo "niet genoeg geld";
};
header("location: index.php");
?>