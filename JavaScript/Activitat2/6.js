var intro = prompt("Correu electronico"),counter = 0;

for (var i = 0; i < intro.length; i++){
    if("@" == intro.charAt(i)){
        counter++;
    }
}

if (counter == 0){
    alert("Una adreça de correu ha de contenir el caracter @");

} else if (counter > 1){
    alert("Una adreça de correu no pot tenir mes d'un caracter @");

} else {
    alert("L'adreça especificada es correcta");
    
}