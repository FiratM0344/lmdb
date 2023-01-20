<?php
session_start();
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->loterij->user;
$username = $_SESSION["username"];
$result = $collection->deleteMany(["username" => $username], ["username"]);
header("location: logout.php");
?>