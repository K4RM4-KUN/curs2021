<?php
    session_start();
    include("libraryShop.php");
    include("libraryRecover.php");
    include("library.php");
    controlLogedPublicIndexOnly();
    if(isset($_REQUEST["recover"])){
        $error = testInputs();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recovery Password</title>
</head>
<body>
    <a href="login.php"><button type="button">Atras</button></a>
    <div style="text-align: center; margin-top:10px;">
        <form  method="post" id="recoverPass" name="recover">
            <p><?php if(isset($error)){echo "<b>".$error."</b>";} else {echo "</br>";}?></p>
            <label for="mail">Email </label><input type="text" name="emailrecover" id="emailrecover"></br></br>
            <input type="submit" value="Recuperar contraseña" name="recover"></br></br>
        </form>
    </div>
</body>
</html>