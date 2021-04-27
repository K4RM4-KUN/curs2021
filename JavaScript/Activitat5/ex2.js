
//Ejercicio4
document.querySelector("#ex4imp").addEventListener("click", function() {location.href="./ex4.html";});

var cosaEx4 = localStorage.getItem("ex4color"); 
if(cosaEx4 != "white" || cosaEx4 != "#080e57" || cosaEx4 != "#691519" || cosaEx4 != "#083b10"){;
    location.href="./ex4.html";
} else {
    document.querySelector("#ex2body").style.backgroundColor=cosaEx4;
}

//Ejercicio2
var cosa = localStorage.getItem("ex2counter");
if(cosa == "NaN" || cosa == null){;
    localStorage.setItem("ex2counter","1");

} else {
    let value = parseInt(cosa);
    value+=1;
    localStorage.setItem("ex2counter",value.toString());
}
cosa = localStorage.getItem("ex2counter");
document.querySelector("#ex2").innerHTML = cosa;

