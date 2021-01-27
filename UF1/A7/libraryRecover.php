<?php
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';
require './phpmailer/src/Exception.php';
require './phpmailer/src/OAuth.php';

//
function recovering(){
    if($_GET["token"] != $_SESSION["privateToken"] || $_GET["email"]  != $_SESSION["userR"]){
        header("Location:index.php");
    }
}

//
function testInputs(){
    $error = "";
    if(empty($_REQUEST["emailrecover"])){
        $error = "Este campo es obligatorio";
    } else {
        if (!filter_var($_REQUEST["emailrecover"], FILTER_VALIDATE_EMAIL)) {
            $error = "El campo \"Email\" debe ser un email.";

        } else {
            $error = sendMail($_REQUEST["emailrecover"]);
        }
    }
    return $error;
}

function testInputsNewPass($nPass,$nPassR){
    $error = "";
    $email = $_SESSION["userR"];
    if($nPass == $nPassR){
        $conn = connectToDB();
        $pass = consultDB("users",$email,"email");
        try{
            $sql = ("UPDATE users SET pass='$nPass' WHERE email='$email'");
            $conn -> query($sql);
            $conn->close();
        } catch(mysqli_sql_exception $e){
            $e->errorMessage();
        }
        $_SESSION["token"] = "";
        $_SESSION["userR"] = "";
        header("Location:login.php");
    } else {
        $error = "Las contraseñas no coinciden! Intentalo de nuevo!";
    }
    return $error;
}

function sendMail($email){
    $error = "";
    if(userExists($email)){
        $token = newCode(20);
        $_SESSION["privateToken"] = $token;
        $_SESSION["userR"] = $email;
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "jfuentesa@fp.insjoaquimmir.cat";
        $mail->Password = "calabasa";
        $mail->setFrom('no-replay@my.web', 'Password Recovery - My Web.');
        $mail->addAddress($email, 'Sr/ra');
        $mail->Subject = 'Recuperacion de contraseña.';
        $mail->Body = '<html><body>Hola,'.$email.'</br> para poder recuperar la contraseña debes hacer click <a href="https://dawjavi.insjoaquimmir.cat/jfuentes/UF1/A7/changePass.php?email='.$email.'&token='.$token.'">aquí</a>.</body></html>';
        $mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
        $mail->IsHTML(true);
        if ($mail->send()){
            $error = "Un correo ha sido enviado a ".$email;
        } else {
            $error = "Parece que ha habido un error, prueba otra vez.";
        }
    } else {
        $error = "Este email no existe en nuestra BD.";
    }
    return $error;
}

?>