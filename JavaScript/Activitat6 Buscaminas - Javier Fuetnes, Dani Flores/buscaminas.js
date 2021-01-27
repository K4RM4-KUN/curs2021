var mineField = [];
var tableto = [];
var saved = [];
var flags = [];
var around = [-11,-10,-9,-1,1,9,10,11];
var leftWing = [0,10,20,30,40,50,60,70,80,90];
var rightWing = [9,19,29,39,49,59,69,79,89,99];

var detectedMine = 10;
var cell = document.querySelectorAll("td");
var times;

for(let i=0;i<cell.length;i++){
    cell[i].className = "cell";
}
console.log(mineField);
console.log(tableto);
console.log(saved);
console.log(flags);
console.log(detectedMine);
document.getElementById("iniciar").addEventListener("click",function(){
    if(document.getElementById("iniciar").value == "Reiniciar"){
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
    //console.log(mineField);
    //console.log(tableto)
    //printNumbers();
});
function timer(){
    clearInterval(times);
    var time = 0;
    times = setInterval(function(){ time+=1;document.querySelector("#timer").innerHTML = time; }, 1000);
}


function flag(id){
    console.log(flags);
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
    localStorage.setItem("startedGame",true)
    localStorage.setItem("savedMineField",mineField)
    localStorage.setItem("savedTableto",tableto)
    localStorage.setItem("savedCells",saved)
    localStorage.setItem("savedFlags",flags)
    localStorage.setItem("savedDetectedMine",detectedMine)
    localStorage.setItem("savedTimes",times)
}

function randomMines(){
    for(let i=0;i<10;i++){
        do{
            var mine = Math.floor(Math.random() * 100);
        }while(mineField.includes(mine));
        mineField.push(mine);
        for(let v=0;v<around.length;v++){
            if(leftWing.includes(mine) && !rightWing.includes(mine+around[v])){
                if(!((mine+around[v]) > 99) && !((mine+around[v]) < 0)){
                    tableto[(mine+around[v])]++;
                }
            } else if(rightWing.includes(mine) && !leftWing.includes(mine+around[v])){
                if(!((mine+around[v]) > 99) && !((mine+around[v]) < 0)){
                    tableto[(mine+around[v])]++;
                }
            } else if(!((mine+around[v]) > 99) && !((mine+around[v]) < 0) && !leftWing.includes(mine) && !rightWing.includes(mine)){
                tableto[(mine+around[v])]++;
            }
        }
    }
}
function winOrLose(){
    let tmpBool = true;
    for(let i=0;i < mineField.length;i++){
        if(saved.includes(mineField[i])){
            tmpBool = false;
        }
    }
    
    return tmpBool;
}
function uncover(id){
    let tmpBool;
    if (saved.length > 90){
        tmpBool = winOrLose();
    }
    if(!tmpBool && !saved.includes(id) && document.getElementById("iniciar").value != "Volver a jugar" && !flags.includes(id)){
        saved.push(id);
        console.log(saved);
        if(mineField.includes(id)){
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
                tmp.setAttribute("id", id);
                tmp.width = 28;
            }
            
        }else if (tableto[id] > 0){
            //console.log(id+"destapa");
            cell[id].innerHTML = tableto[id];
        } else if(!(id > 99) && !(id < 0)){
            for(let v=0;v<around.length;v++){
                if(leftWing.includes(id) && !rightWing.includes(id+around[v])){
                    if(!((id+around[v]) > 99) && !((id+around[v]) < 0)){
                        if(!saved.includes(id+around[v])){
                            uncover(id+around[v]);
                        }
                    }
                } else if(rightWing.includes(id) && !leftWing.includes(id+around[v])){
                    if(!((id+around[v]) > 99) && !((id+around[v]) < 0)){
                        if(!saved.includes(id+around[v])){
                            uncover(id+around[v]);
                        }
                    }
                } else if(!((id+around[v]) > 99) && !((id+around[v]) < 0) && !leftWing.includes(id) && !rightWing.includes(id)){
                    if(!saved.includes(id+around[v])){
                        uncover(id+around[v]);
                    }
                }
                cell[id].className = "secure";
            }
        } else {
            console.log(id+"nada");
        }
    }else{
        if(tmpBool){
            document.getElementById("iniciar").value = "Volver a jugar";
            clearInterval(times);
            alert("HAS GANADO!");

        }
    
    } 
    localStorage.setItem("startedGame",true)
    localStorage.setItem("savedMineField",mineField)
    localStorage.setItem("savedTableto",tableto)
    localStorage.setItem("savedCells",saved)
    localStorage.setItem("savedFlags",flags)
    localStorage.setItem("savedDetectedMine",detectedMine)
    localStorage.setItem("savedTimes",times)
    
   
}

function printNumbers(){
    cell = document.querySelectorAll("td");
    for(let i=0;i<100;i++){
        if(tableto[i] != 0 && !(mineField.includes(i))){
            cell[i].innerHTML = tableto[i];
        } else if ((mineField.includes(i))){
            cell[i].innerHTML = "M";
        }
    }
}