document.getElementById("iniciar").addEventListener("click",function(){
    var tableto = new Board();
    if(document.getElementById("iniciar").value == "Reiniciar"){
        tableto.restart();
    } else if(document.getElementById("iniciar").value == "Iniciar") {
        tableto = [];
        for(let i=0;i<100;i++){
            tableto.push(0);
        }
        for(let i=0;i<cell.length;i++){
            cell[i].className = "cell";
            cell[i].addEventListener("click",function(){
                uncover((parseInt(cell[i].id)-1));});
            cell[i].addEventListener("contextmenu",function(event){
                flag((parseInt(cell[i].id)-1));event.preventDefault();});
        }
    } else if(document.getElementById("iniciar").value == "Volver a jugar"){
        saved = [];
        mineField = [];
        flags = [];
        detectedMine = 10;
        document.querySelector("#counter").innerHTML = detectedMine;
        for(let i=0;i<100;i++){
            cell[i].className = "cell";
            cell[i].innerHTML = null;
            tableto[i] = 0;
        }
    }
    randomMines();
    timer();
    document.getElementById("iniciar").value = "Reiniciar";
});

var Board = function(){
    this.tableto = [];
    this.mineField = [];
    this.cell = document.querySelectorAll("td");
    this.numBomb = 10;

    this.create = function(){
        for(let i=0;i<document.querySelectorAll("td");i++){
            document.querySelectorAll("td")[i].className = "cell";
        }
        for(let i=0;i<100;i++){
            this.tableto.push(0);
        }
        for(let i=0;i<this.cell.length;i++){
            this.cell[i].className = "cell";
            this.cell[i].addEventListener("click",function(){
                let tmp = new Cell((parseInt(cell[i].id)-1));Cell.uncover();});
            this.cell[i].addEventListener("contextmenu",function(event){
                flag((parseInt(cell[i].id)-1));event.preventDefault();});
        }
    }

    this.generateField = function (){
        var around = [-11,-10,-9,-1,1,9,10,11];
        var leftWing = [0,10,20,30,40,50,60,70,80,90];
        var rightWing = [9,19,29,39,49,59,69,79,89,99];
        for(let i=0;i<this.numBomb;i++){
            do{
                var mine = Math.floor(Math.random() * 100);
            }while(mineField.includes(mine));
            mineField.push(mine);
            for(let v=0;v<around.length;v++){
                if(leftWing.includes(mine) && !rightWing.includes(mine+around[v])){
                    if(!((mine+around[v]) > 99) && !((mine+around[v]) < 0)){
                        this.tableto[(mine+around[v])]++;
                    }
                } else if(rightWing.includes(mine) && !leftWing.includes(mine+around[v])){
                    if(!((mine+around[v]) > 99) && !((mine+around[v]) < 0)){
                        this.tableto[(mine+around[v])]++;
                    }
                } else if(!((mine+around[v]) > 99) && !((mine+around[v]) < 0) && !leftWing.includes(mine) && !rightWing.includes(mine)){
                    this.tableto[(mine+around[v])]++;
                }
            }
        }
    }

    this.restart = function (){
        this.tableto = [];
        this.mineField = [];
        this.numBomb = 10;
        document.querySelector("#counter").innerHTML = detectedMine;
        for(let i=0;i<100;i++){
            cell[i].className = "cell";
            cell[i].innerHTML = null;
            tableto[i] = 0;
        }
        this.create();
        this.generateField();
    }
}

var Cell = function(id){
    this.location = id;
    this.content;
    this.markFlag;

    this.uncover = function(){
        let tmpBool;
        if (saved.length > 90){
            tmpBool = winOrLose();
        }
        if(!tmpBool && !saved.includes(this.location) && document.getElementById("iniciar").value != "Volver a jugar" && !flags.includes(this.location)){
            saved.push(this.location);
            console.log(saved);
            if(mineField.includes(this.location)){
                clearInterval(times);
                document.getElementById("iniciar").value = "Volver a jugar";
                    let tmp = document.querySelectorAll(".flag");
                    for(let i=0;i<flags.length;i++){
                            tmp[i].remove();
                            tmp[i].classList.remove("flag");
                        
                    }   
                for(let i=0;i<mineField.length;i++){
                    let tmp = document.createElement("img");
                    cell[mineField[i]].appendChild(tmp);
                    tmp.className = "mine";
                    tmp.src = "./images/mine.jpg";
                    tmp.setAttribute("id", this.location);
                    tmp.width = 28;
                }
                
            }else if (tableto[id] > 0){
                //console.log(id+"destapa");
                cell[this.location].innerHTML = tableto[this.location];
            } else if(!(this.location > 99) && !(this.location < 0)){
                for(let v=0;v<around.length;v++){
                    if(leftWing.includes(id) && !rightWing.includes(id+around[v])){
                        if(!((id+around[v]) > 99) && !((id+around[v]) < 0)){
                            if(!saved.includes(id+around[v])){
                                uncover(id+around[v]);
                            }
                        }
                    } else if(rightWing.includes(this.location) && !leftWing.includes(id+around[v])){
                        if(!((id+around[v]) > 99) && !((id+around[v]) < 0)){
                            if(!saved.includes(id+around[v])){
                                uncover(id+around[v]);
                            }
                        }
                    } else if(!((this.location+around[v]) > 99) && !((this.location+around[v]) < 0) && !leftWing.includes(this.location) && !rightWing.includes(this.location)){
                        if(!saved.includes(this.location+around[v])){
                            uncover(id+around[v]);
                        }
                    }
                    cell[id].className = "secure";
                }
            } else {
                console.log(this.location+"nada");
            }
        }else{
            if(tmpBool){
                document.getElementById("iniciar").value = "Volver a jugar";
                clearInterval(times);
                alert("HAS GANADO!");
    
            }
        
        } 
    }

    this.Flag = function(){
        if(!saved.includes(id) && document.getElementById("iniciar").value != "Volver a jugar"){
            if(flags.includes(id)){
                let tmp = document.querySelectorAll(".flag");
                for(let i=0;i<flags.length;i++){
                    if(tmp[i].id == id){;
                        tmp[i].remove();
                        tmp[i].classList.remove("flag");
                    }
                }
                for(let i=0;i<flags.length;i++){
                    if(flags[i] == id){
                        flags.splice(i,1);
                    }
                }
                detectedMine+=1;
                document.querySelector("#counter").innerHTML = detectedMine;
            } else if(detectedMine != 0) {
                var newTmp = document.createElement("img");
                cell[id].appendChild(newTmp);
                newTmp.className = "flag";
                newTmp.src = "./images/flag.png";
                newTmp.setAttribute("id", id);
                flags.push(id);
                detectedMine-=1;
                document.querySelector("#counter").innerHTML = detectedMine;
                newTmp.width = 25;
            }
        }
    }
}

var Timer = function(){
    this.clock;

    this.active = function(time){
        this.clock = setInterval(function(){ time+=1;document.querySelector("#timer").innerHTML = time; }, 1000);

    }

    this.stop = function(){
        clearInterval(times);
    }

    this.reset = function(){
        clearInterval(this.clock);
        var time = 0;
        this.active(time);
    }
}

var FlagCounter = function(){
    this.numFlags = 10;

    this.increment = function(){
        this.numFlags += 1;
    }

    this.decrement = function(){
        this.numFlags -= 1;
    }
}