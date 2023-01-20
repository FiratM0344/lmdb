<?php
session_start();
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->loterij->user;
$username = $_SESSION["username"];
$result = $collection->find(["username" => $username], ["balance"]);
$rich = 200;
$getRich = $collection->updateOne(["username" => $username], ['$set' => ["balance" => $rich]]);
header("location: profile.php");
?>