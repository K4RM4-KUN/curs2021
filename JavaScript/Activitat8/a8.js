var button = document.getElementById("go");
var text = document.getElementById("txt");

button.addEventListener('click',function(){
    let characters = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"]
    let values = [];
    for(i in characters){values.push(0);}
    let tmp = text.value.toUpperCase();
    for(i in characters){
        for(x of tmp){
            if(characters[i] == x){
                values[i] += 1;
            }
        }
    }
    console.log("");
    let index = 0;
    characters.forEach(function(char){
        console.log("Letra "+char+": "+values[index]+".");
        index++;
    });

});
