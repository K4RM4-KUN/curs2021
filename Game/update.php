<?php
include 'library.php';

if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password2"])){
    $conn = connectToDB();

    $email = $_POST["email"];
    $pass = $_POST["password"];
    $pass2 = $_POST["password2"];  
    if($pass == ""){
        echo "passEmpty";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "emailE";

    } else if($pass == $pass2){
        $passnew = md5($pass);

        $sql = "UPDATE users SET password = '$passnew' WHERE mail = '$email'";

        if ($conn->query($sql) === TRUE) {
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
