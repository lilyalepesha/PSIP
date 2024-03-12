<?php
session_start();
$_SESSION["name"] = "admin";
$_SESSION["age"] = 11;
if (isset($_SESSION["name"]) && isset($_SESSION["age"])) {
    $name = $_SESSION["name"];
    $age = $_SESSION["age"];
    echo "Name: $name <br> Age: $age";
}
?>
