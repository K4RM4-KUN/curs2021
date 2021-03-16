<?php
include 'library.php';

if(isset($_POST["time"]) && isset($_POST["level"]) && isset($_POST["email"])){
    $conn = connectToDB();

    $time = floatval($_POST["time"]);
    $level = $_POST["level"];
    $username = $_POST["email"];
    $userid = 999;

    $cons = "SELECT id FROM users WHERE mail = '$username'";

    $result = $conn->query($cons);

    if($result->num_rows == 1){
        while($row = $result->fetch_assoc()){  
            $userid = $row["id"];
        }
    } else {
        echo "error1";
        die;
    }

    $sql = "SELECT * FROM times WHERE user_id = '$userid' and level='$level'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){  
            $sql = "UPDATE times SET time = '$time' WHERE user_id ='$userid' and level ='$level'";

            if($conn->query($sql) === true){
                echo "succses";
            } else {
                echo "error2";
            }

        }
    } else { 
        $sql = "INSERT INTO times (user_id,time,level)
        VALUES ('$userid','$time','$level')";
    
        if($conn->query($sql) === true){
            echo "succses";
        } else {
            echo $conn->error;
        }

        die;
    }

    $conn->close();

} else {
    echo "empty";
}


