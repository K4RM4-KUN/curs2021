const redondear = function() {
    let total = 0;
    for(i=0;i< arguments.length;i++){
        total+=arguments[i];
    }
    return total;
}

let totalResult = redondear(1,10,100,1000,10000);

alert("resultado: "+totalResult)
