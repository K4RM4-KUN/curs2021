<?php
    session_start();
    include("libraryRecover.php");
    include("libraryShop.php");
    include("library.php");
    controlLogedPublicIndexOnly();
    recovering();
    if(isset($_REQUEST["setnewpass"])){
        $error = testInputsNewPass(md5($_REQUEST["pass"]),md5($_REQUEST["passrepeat"]));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form  method="post" id="chPass" name="chpass">
        <p><?php if(isset($error)){echo "<b>".$error."</b>";} else {echo "</br>";}?></p>
        <label for="pass">New password </label><input type="password" name="pass" id="pass"></br></br>
        <label for="passrepeat">Repeat password </label><input type="password" name="passrepeat" id="passRepeat"></br></br>
        <input type="submit" value="Cambiar contraseña" name="setnewpass"></br></br>
    </form>
    
</body>
</html>