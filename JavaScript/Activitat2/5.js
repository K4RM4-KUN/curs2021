var intro = prompt("Di algo!"), letra = prompt("Dime una letra");
var counter = 0;
for (var i = 0; i < intro.length; i++){
    if(letra.toUpperCase() == intro.toUpperCase().charAt(i)){
        counter++;
    }
}
alert("La letra "+letra.toUpperCase()+" se repite: "+counter);

