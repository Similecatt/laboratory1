<?php
// db_connect.php
// This file connects to MySQL. Every other page will "include" this file.
 
$host = "localhost";     // server address (localhost = your own computer)
$username = "root";      // default XAMPP username
$password = "";          // default XAMPP password is blank
$dbname = "inventory_db";  // the database we created in database.sql
 
// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>