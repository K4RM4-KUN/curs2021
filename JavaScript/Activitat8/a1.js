button = document.getElementById("generate");
text = document.getElementById("numbers");

button.addEventListener('click',function(){
    var n = [];
    var dupes = [];
    text.innerHTML = "";
    while(n.length!=10){
        n.push(Math.floor(Math.random() * 11));
    }
    text.innerHTML = n.join(' ');
    for(let i=0;i<n.length;i++){
        let tmp = n.pop()
        for(let x=0;x<n.length;x++){
            if(tmp == n[x] && dupes.indexOf(tmp) == -1){
                dupes.push(tmp)
                break;
            }
        }
    }
    if(dupes.length == 0){
        console.log("No hay valores repetidos...");
    } else {
        console.log("Valores repetidos: "+dupes.join(' '));
    }

});