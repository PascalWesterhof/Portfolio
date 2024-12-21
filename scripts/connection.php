<?php 
// connection.php
$dbHost = "mysql-1";
$dbUser = "root";
$dbPass = "qwerty";
$dbName = "portfolio_db"; //naam van de aangemaakte database in phpmyadmin

try {
    $con = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}