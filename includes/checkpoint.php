<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../new_wbs/login.php");
    exit;
}

$name = $_SESSION['name'];
$user_type = $_SESSION['user_type'];

if (isset($_SESSION['user_type'])) {

    if ($_SESSION['user_type'] === "Administrator") {
        header('location: ../index.php');
    } else {
        header('location: ../login.php');
    }
}