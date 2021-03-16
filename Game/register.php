<?php
include 'library.php';

if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password2"]) && isset($_POST["username"])){
    $conn = connectToDB();

    $email = $_POST["email"];
    $pass = $_POST["password"];
    $username = $_POST["username"];
    $pass2 = $_POST["password2"]; 

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "emailE";
    } else if($pass == $pass2){
        $passnew = md5($pass);

        $sql = "INSERT INTO users (username,mail,password)
        VALUES ('$username','$email','$passnew')";
    
        if($conn->query($sql) === true){
            echo "succses";
        } else {
            echo "error";
        }

    } else {
        echo "passE";

    }
    
    $conn->close();

} else {
    echo "empty";
}


