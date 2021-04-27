var hora = prompt("Que hora es?")*1;
if (hora <= 12 && hora >= 6){
    alert("Bon dia!");
} else if (hora <= 18 && hora >= 12){
    alert("Bona tarda!");
} else {
    alert("Bona nit!");
}