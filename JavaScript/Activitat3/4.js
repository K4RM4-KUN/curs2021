function sumar(a,b){
    return [a+b,a-b,a*b];
}
let total = sumar(2,0);
alert("Suma="+total[0]+", Resta="+total[1]+", Multiplicacion="+total[2]);