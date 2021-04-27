var d = new Date();
var secs = d.getSeconds();
var milisecs = d.getMilliseconds();

let nope = prompt("Canto es 678 + 932:");

d = new Date();
if (secs > d.getSeconds || milisecs > d.getMilliseconds){
    secs = secs - d.getSeconds();
    milises = milisecs - d.getMilliseconds();

} else{
    secs = d.getSeconds() - secs;
    milises = d.getMilliseconds() - milisecs;

}

alert("Has tardado: "+secs+","+milisecs+" segundos.");
