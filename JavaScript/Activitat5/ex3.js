let color = getCookie("ex3color");
    
document.querySelector("#ex3Blue").addEventListener("click", function() {color ="#080e57";});
document.querySelector("#ex3Red").addEventListener("click", function() {color ="#691519";});
document.querySelector("#ex3Green").addEventListener("click", function() {color ="#083b10";});
document.querySelector("#ex3White").addEventListener("click", function() {color = "white";});
document.querySelector("#ex3Save").addEventListener("click", function() {setCookie("ex3color",color,365); location.href="./ex1.html";});

var cosa = getCookie("ex3color"); 
if(cosa != "white" || cosa != "#080e57" || cosa != "#691519" || cosa != "#083b10"){
    setCookie("ex3color","white",365);
}

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
 