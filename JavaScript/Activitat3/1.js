//var intro = prompt("Correo electronico");

//function validarCorreo(intro) {
//    var counter = 0;
//    var tmpBool = false;
//    for (var i = 0; i < intro.length; i++){
//        if("@" == intro.charAt(i)){
//            counter++;
//        }
//    }
//
//    if (counter == 1){
//        tmpBool = true;
//
//    } else {
//        tmpBool = false;
//    }
//    
//    return tmpBool;
//}
//var lol = validarCorreo(intro);
//
//alert("El resultado es: "+lol);

//Flecha funcion
//var intro = prompt("Correo electronico");
//
//const validarCorreo = (intro) => {
//    var counter = 0;
//    var tmpBool = false;
//    for (var i = 0; i < intro.length; i++){
//        if("@" == intro.charAt(i)){
//            counter++;
//       }
//    }
//
//    if (counter == 1){
//       tmpBool = true;
//
//    } else {
//        tmpBool = false;
//    }
//    
//    return tmpBool;
//}
//var lol = validarCorreo(intro);
//
//alert("El resultado es: "+lol);


//Anonimo funcion
var intro = prompt("Correo electronico");

const validarCorreo = function(intro) {
    var counter = 0;
    var tmpBool = false;
    for (var i = 0; i < intro.length; i++){
        if("@" == intro.charAt(i)){
            counter++;
       }
    }

    if (counter == 1){
       tmpBool = true;

    } else {
        tmpBool = false;
    }
    
    return tmpBool;
}
var lol = validarCorreo(intro);

alert("El resultado es: "+lol);
