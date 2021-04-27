v3Txt = document.getElementById("v3");
var v1 = [];
var v2 = [];
var dupes = [];

function fill(array){
    while(array.length!=10){
        array.push(Math.floor(Math.random() * 10) + 1);
    }
}

fill(v1);
fill(v2);

for(let x=0;x<10;x++){
    let tmp1 = v1.pop();
    let tmp2 = v2.pop();
    if(tmp1 == tmp2 && dupes.indexOf(tmp1) == -1){
        dupes.push(tmp1);
    }
}
if(dupes.length == 0){
    v3Txt.innerHTML = "No hay numeros repetidos";
} else {
    dupes.forEach(element => v3Txt.innerHTML += " "+element)
}
