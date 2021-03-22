<?php

$conn = new mysqli("localhost", "root", "root");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    exit();
}
$db_selected = $conn->select_db("currency_converter");

if(!$db_selected) {
    $sql  = $conn->query('CREATE DATABASE currency_converter');
    if($sql) {
        echo "Database currency_converter created successfully";
    }
    else {
        echo mysqli_error("error creating database: \n");
    }
}
else {
    echo "currency_converter already exists";
}

$db_selected = $conn->select_db("currency_converter");
$table = "currency_conversion";
$sql_create = "CREATE TABLE IF NOT EXISTS $table (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    src_currency VARCHAR(20) NOT NULL,
    tar_currency VARCHAR(20) NOT NULL,
    amount FLOAT NOT NULL,
    result FLOAT
)";

if($conn->query($sql_create) === TRUE) {
    echo "Table currency_conversion created successfully";
}
else {
    echo "error creating table currency_conversion ". $conn->error;
}

mysqli_close($conn);


?>