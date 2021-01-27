var intro = prompt("Di algo!"),pos = prompt("Dime una posicion de la frase que has puesto");
parseInt(pos)
while (pos == 0 || pos > intro.length) {
    pos = prompt("Te has equivocado pon otro numero, quizas tu frase no es tan larga...")
}
pos--;
alert(intro.charAt(pos));