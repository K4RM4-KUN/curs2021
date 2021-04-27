var intro = prompt("Di algo!");
var introRev = "";
for (var i = intro.length-1; i>-1; i--) {
    introRev += intro[i];
}
alert(introRev);