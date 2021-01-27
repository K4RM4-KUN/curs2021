var button = document.getElementById("go");
var text = document.getElementById("txt");

button.addEventListener('click',function(){
    let splitedText = text.value.split(" ");
    console.log("Nº de palabras: "+splitedText.length);
    console.log("Primera palabra : "+splitedText[0]);
    console.log("Ultima palabra : "+splitedText[splitedText.length-1]);
    console.log("Al reves : "+splitedText.reverse().join(", "));
    console.log("A - Z : "+splitedText.sort().join(", "));
    console.log("Z - A : "+splitedText.reverse().join(", "));
});
