
//Ejercicio3
document.querySelector("#ex3imp").addEventListener("click", function() {location.href="./ex3.html";});

var cosaEx3 = getCookie("ex3color"); 
if(cosaEx3 == ""){;
    location.href="./ex3.html";
} else {
    document.querySelector("#ex1body").style.backgroundColor=cosaEx3;
}

//Ejercicio1
var cosa = getCookie("ex1counter"); 
if(cosa == ""){;
    setCookie("ex1counter",1, 365);

} else {
    let value = parseInt(cosa);
    value+=1;
    setCookie("ex1counter",value, 365);
}
cosa = getCookie("ex1counter");
document.querySelector("#ex1").innerHTML = cosa;



function getCookie(nom) {
    var name = nom + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0){
            return c.substring(name.length,c.length);
        }
    }   return "";
}

function setCookie(camp, valor, dies) {
    var d = new Date();
    d.setTime(d.getTime() + (dies*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = camp + "=" + valor + ";" + expires; 
}
 