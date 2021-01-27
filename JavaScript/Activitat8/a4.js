var suit = ["oros","copas","espadas","vastos"];
var number = ["1","2","3","4","5","6","7","8","9","10","11","12"];
var deck = [];
var hand = [];

for (var x=0; x<suit.length;x++){
    for (var i=0; i<number.length;i++){
        deck.push(number[i]+suit[x]);
    }
}

deck.sort(function(a,b){return 0.5 - Math.random()});

for(var x=0;x<5;x++){
    hand.push(deck.pop());
}   
hand.forEach(function(i){
    console.log(i);
});
