buttonAF = document.getElementById("addFirst");
buttonAL = document.getElementById("addLast");
buttonDF = document.getElementById("delFirst");
buttonDL = document.getElementById("delLast");
text = document.getElementById("txt");
var n = [];

buttonAL.addEventListener('click',function(){
    n.push(Math.floor(Math.random() * 11));
    text.value = n.join('-');
});

buttonDL.addEventListener('click',function(){
    n.pop();
    text.value = n.join('-');
});

buttonAF.addEventListener('click',function(){
    n.unshift(Math.floor(Math.random() * 11));
    text.value = n.join('-');
});

buttonDF.addEventListener('click',function(){
    n.shift();
    text.value = n.join('-');
});