var mes = prompt("Que mes es?(Valor numerico)");
if (mes < 2 && mes > 12){
    alert("Sóm a l'hivern");
} else if (mes > 3 && mes < 5){
    alert("Sóm a la primavera");
} else if (mes > 6 && mes < 8){
    alert("Sóm a l'estiu!");
} else if (mes > 6 && mes < 8){
    alert("Sóm a la tardor");
} else {
    alert("Has escrit malament o no has escrit el numero de un mes!")
}