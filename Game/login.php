<?php
include 'library.php';

if(isset($_POST["email"]) && isset($_POST["password"])){
    $conn = connectToDB();

    $email = $_POST["email"];
    $pass = $_POST["password"];

    $sql = "SELECT password FROM users WHERE mail = '$email'";
    $result = $conn->query($sql);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "emailE";
        
    } else if($result->num_rows == 1){
        while($row = $result->fetch_assoc()){
            if($row["password"] == md5($pass)){
                echo "loged";
            } else {
                echo "passE";
            }

        }
    } else {
        echo "userE";
    }

    $conn->close();
} else {
    echo "empty";
}
