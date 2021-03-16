<?php
include 'library.php';

if(isset($_POST["time"]) && isset($_POST["level"]) && isset($_POST["email"])){
    
$sql = "SELECT * from times order by time ASC limit 3";

$result = $conn->query($sql);

if ($result->num_rows > 0){
    // salida de datos
    while($row = $result->fetch_assoc()){
        echo $row["time"]."ª";
    }
}else {
    echo "0.";
}