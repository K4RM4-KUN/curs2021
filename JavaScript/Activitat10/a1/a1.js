var counter = $("small");
localStorage.setItem("wins",0);
localStorage.setItem("winsB",0);
var usedCards = [];
var usedCardsBot = [];
var usedCardsPlayer = [];
var times;
var number = ["2","3","4","5","6","7","8","9","10","J","Q","K","A"];
var suit = ["C","D","H","S"];

$("#btn_demanar").click(function(){giveCard();});
$("#btn_noujoc").click(function(){start();});
$("#btn_aturar").click(function(){stop(); computerTurn();});

function timer(){
    clearInterval(times);
    var time = 0;
    times = setInterval(function(){ time+=1;$(".subtitol")[0].innerHTML = time+" segons"; }, 5000);
}

function start(){
    usedCards = [];
    usedCardsBot = [];
    usedCardsPlayer = [];
    $(counter)[0].innerHTML = 0;
    $(counter)[1].innerHTML = 0;
    $("#btn_demanar").attr("disabled", false);
    $("#btn_aturar").attr("disabled", false);
    $(".cartah").remove();
    $(".cartac").remove();
    timer();
}

function stop(){
    $("#btn_demanar").attr("disabled", true);
    $("#btn_aturar").attr("disabled", true);
    clearInterval(times);
    setTimeout(function(){alert(winner());$(".subtitol")[0].innerHTML = "IA: "+localStorage.getItem("winsB")+"---"+localStorage.getItem("wins")+" :HUMAN";},100);
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
    if(usedCardsPlayer.length == 0){
        $("<img/>",{
            'class' : 'cartah',
            'src' : "./assets/cartes/"+tmpCard
        }).appendTo('#jugador-cartes');
    } else {
        $("<img/>",{
            'class' : 'cartah',
            'src' : "./assets/cartes/"+tmpCard
        }).appendTo('#jugador-cartes');
    }
    cardValue(tmpNumber,0);
    if(parseInt($(counter)[0].innerHTML) >= 21){
        computerTurn();
        stop(); 
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
    $(counter)[player].innerHTML = (result + parseInt($(counter)[player].innerHTML));
}

function computerTurn(){
    if(parseInt($(counter)[0].innerHTML) <= 21){
        while(parseInt($(counter)[0].innerHTML) >= parseInt($(counter)[1].innerHTML) || parseInt($(counter)[1].innerHTML) == 21){
            let tmpCard = "";
            let tmpNumber;
            do{
                tmpNumber = number[Math.floor(Math.random() * number.length)];
                tmpCard = tmpNumber + suit[Math.floor(Math.random() * suit.length)];
            } while(usedCards.includes(tmpCard));

            usedCards.push(tmpCard);
            usedCardsBot.push(tmpCard);
            tmpCard += ".png";
            if(usedCardsBot.length == 0){
                $("<img/>",{
                    'class' : 'cartac',
                    'src' : "./assets/cartes/"+tmpCard
                }).appendTo('#ordinador-cartes');
            } else {
                $("<img/>",{
                    'class' : 'cartac',
                    'src' : "./assets/cartes/"+tmpCard
                }).appendTo('#ordinador-cartes');
            }
            cardValue(tmpNumber,1);
        }

    } else if(parseInt($(counter)[0].innerHTML) > 21){
        let tmpCard = "";
            let tmpNumber;
            do{
                tmpNumber = number[Math.floor(Math.random() * number.length)];
                tmpCard = tmpNumber + suit[Math.floor(Math.random() * suit.length)];
            } while(usedCards.includes(tmpCard));

            usedCards.push(tmpCard);
            usedCardsBot.push(tmpCard);
            tmpCard += ".png";
            if(usedCardsBot.length == 0){
                $("<img/>",{
                    'class' : 'cartac',
                    'src' : "./assets/cartes/"+tmpCard
                }).appendTo('#ordinador-cartes');
            } else {
                $("<img/>",{
                    'class' : 'cartac',
                    'src' : "./assets/cartes/"+tmpCard
                }).appendTo('#ordinador-cartes');
            }
            cardValue(tmpNumber,1);
    }
}

function winner(){
    let result = "NADIE HA GANADO...";
    let c0 = parseInt($(counter)[0].innerHTML); 
    let c1 = parseInt($(counter)[1].innerHTML);
    if(c0 == c1){
        result = "HA SIDO UN EMPATE! QUE PARTIDA!";
        console.log(parseInt($(counter)[0].innerHTML)+""+parseInt($(counter)[1].innerHTML));
    } else {
        if((c0 > c1 && c0 < 21 || c0 == 21) || (c0 < c1 && c1 > 21)){
            result = "HA GANADO EL HUMANO!";
            localStorage.setItem("wins",parseInt(localStorage.getItem("wins"))+1);
        } else if((c1 > c0 && c1 < 21 || c1 == 21) || (c1 < c0 && c0 > 21)){
            result = "HA GANADO EL ROBOT!";
            localStorage.setItem("winsB",parseInt(localStorage.getItem("winsB"))+1);
        }
    }
    return result;
}

timer();