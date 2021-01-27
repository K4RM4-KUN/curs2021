const round = (n1,n2) => parseFloat(n1).toFixed(n2);

var n1 = prompt("numero decimal");
var n2 = prompt("cifras a redondear")

let tempResult = round(n1,n2);
alert(tempResult);