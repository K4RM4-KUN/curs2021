let playerCards = document.querySelectorAll(".cartah");
let botCards = document.querySelectorAll(".cartac");
var counter = document.querySelectorAll("small");
localStorage.setItem("wins",0);
localStorage.setItem("winsB",0);
var usedCards = [];
var usedCardsBot = [];
var usedCardsPlayer = [];
var times;
var number = ["2","3","4","5","6","7","8","9","10","J","Q","K","A"];
var suit = ["C","D","H","S"];

document.getElementById("btn_demanar").addEventListener("click",function(){giveCard();});
document.getElementById("btn_noujoc").addEventListener("click",function(){start();});
document.getElementById("btn_aturar").addEventListener("click",function(){stop(); computerTurn();});

function timer(){
    clearInterval(times);
    var time = 0;
    times = setInterval(function(){ time+=1;document.querySelector(".subtitol").innerHTML = time+" segons"; }, 1000);
}

function start(){
    usedCards = [];
    usedCardsBot = [];
    usedCardsPlayer = [];
    counter[0].innerHTML = 0;
    counter[1].innerHTML = 0;
    document.getElementById("btn_demanar").disabled = false;
    document.getElementById("btn_aturar").disabled = false;
    for(let i=0;i<playerCards.length;i++){
        playerCards[i].src = "./assets/cartes/blanc.png";
    }
    for(let i=0;i<playerCards.length;i++){
        botCards[i].src = "./assets/cartes/blanc.png";
    }
    timer();
}

function stop(){
    document.getElementById("btn_demanar").disabled = true;
    document.getElementById("btn_aturar").disabled = true;
    clearInterval(times);
    setTimeout(function(){alert(winner());document.querySelector(".subtitol").innerHTML = "IA: "+localStorage.getItem("winsB")+"---"+localStorage.getItem("wins")+" :HUMAN";},100);
}

function giveCard(){
    let tmpCard = "";
    let tmpNumber;
    do{
        tmpNumber = number[Math.floor(Math.random() * number.length)];
        tmpCard = tmpNumber + suit[Math.floor(Math.random() * suit.length)];
    } while(usedCards.includes(tmpCard));

    usedCards.push(tmpCard);
    usedCardsPlayer.push(tmpCard);
    tmpCard += ".png";
    playerCards[usedCardsPlayer.length-1].src = "./assets/cartes/"+tmpCard;
    cardValue(tmpNumber,0);
    if(parseInt(counter[0].innerHTML) >= 21){
        stop(); 
        computerTurn();
    }
}

function cardValue(card,player){
    let result;
    if(card == "J" || card == "Q" || card == "K"){
        result = 11;
    } else if(card == "A"){
        result = 12;
    } else {
        result = parseInt(card);
    }
    counter[player].innerHTML = result + parseInt(counter[player].innerHTML);
}

function computerTurn(){
    if(parseInt(counter[0].innerHTML) <= 21){
        while(parseInt(counter[0].innerHTML) >= parseInt(counter[1].innerHTML) || parseInt(counter[1].innerHTML) == 21){
            let tmpCard = "";
            let tmpNumber;
            do{
                tmpNumber = number[Math.floor(Math.random() * number.length)];
                tmpCard = tmpNumber + suit[Math.floor(Math.random() * suit.length)];
            } while(usedCards.includes(tmpCard));

            usedCards.push(tmpCard);
            usedCardsBot.push(tmpCard);
            tmpCard += ".png";
            botCards[usedCardsBot.length-1].src = "./assets/cartes/"+tmpCard;
            cardValue(tmpNumber,1);

        }

    } else if(parseInt(counter[0].innerHTML) > 21){
        let tmpCard = "";
            let tmpNumber;
            do{
                tmpNumber = number[Math.floor(Math.random() * number.length)];
                tmpCard = tmpNumber + suit[Math.floor(Math.random() * suit.length)];
            } while(usedCards.includes(tmpCard));

            usedCards.push(tmpCard);
            usedCardsBot.push(tmpCard);
            tmpCard += ".png";
            botCards[usedCardsBot.length-1].src = "./assets/cartes/"+tmpCard;
            cardValue(tmpNumber,1);
    }
}

function winner(){
    let result = "NADIE HA GANADO...";
    if(parseInt(counter[0].innerHTML) == parseInt(counter[1].innerHTML)){
        result = "HA SIDO UN EMPATE! QUE PARTIDA!";
        console.log(parseInt(counter[0].innerHTML)+""+parseInt(counter[1].innerHTML));
    }
    if(parseInt(counter[0].innerHTML) > parseInt(counter[1].innerHTML)){
        if(!parseInt(counter[0].innerHTML) > 21){
            result = "HA GANADO EL HUMANO!";
        } else {
            result = "HA GANADO EL ROBOT!";
        }
    } 
    if (parseInt(counter[0].innerHTML) < parseInt(counter[1].innerHTML)){
        if(parseInt(counter[1].innerHTML) < 21){
            result = "HA GANADO EL ROBOT!";
        } else {
            result = "HA GANADO EL HUMANO!";
        }
    }
    if(result == "HA GANADO EL HUMANO!" ){
        localStorage.setItem("wins",parseInt(localStorage.getItem("wins"))+1);
    } else if(result == "HA GANADO EL ROBOT!"){
        localStorage.setItem("winsB",parseInt(localStorage.getItem("winsB"))+1);
    }
    return result;
}

timer();