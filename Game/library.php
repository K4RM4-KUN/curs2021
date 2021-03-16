<?php
function connectToDB(){
    $conn = new mysqli('localhost','jfuentes','jfuentes','jfuentes_game');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    }
    return $conn;
}