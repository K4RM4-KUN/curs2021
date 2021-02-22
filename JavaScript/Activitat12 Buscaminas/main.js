class Builder {
    row = 10;
    col = 10;
    minePosition = [];
    field = [];

    constructor(newRow,newCol){
        this.row = newRow;
        this.col = newCol;
    }

    buildField(){
        for(let i=0;i<100;i++){
            this.field.push(0);
        }
        $("tr.row td.field").each(function(index){
            $(this).delay(25*index).slideDown   ();
        });
        this.fillField();
    }

    fillField(){
        var around = [-11,-10,-9,-1,1,9,10,11];
        var leftWing = [0,10,20,30,40,50,60,70,80,90];
        var rightWing = [9,19,29,39,49,59,69,79,89,99];
        for(let i=0;i<10;i++){
            do{
                var mine = Math.floor(Math.random() * 99)+1;
            }while(this.minePosition.includes(mine));
            this.minePosition.push(mine);
            for(let v=0;v<around.length;v++){
                if(leftWing.includes(mine) && !rightWing.includes(mine+around[v])){
                    if(!((mine+around[v]) > 99) && !((mine+around[v]) < 0)){
                        this.field[(mine+around[v])]+=1;
                    }
                } else if(rightWing.includes(mine) && !leftWing.includes(mine+around[v])){
                    if(!((mine+around[v]) > 99) && !((mine+around[v]) < 0)){
                        this.field[(mine+around[v])]+=1;
                    }
                } else if(!((mine+around[v]) > 99) && !((mine+around[v]) < 0) && !leftWing.includes(mine) && !rightWing.includes(mine)){
                    this.field[(mine+around[v])]+=1;
                }
            }
        }
    }
    
    createTable(){ 
        let $board = $("#board");
        let t = 0;
        $("<tr id='infoBar'><td colspan='5'><div id='progressbar'></div></td><td  id='flags' colspan='5'><h3 id='flags'>10</h3></td></tr>").appendTo($board);
        for(let i=0;i < this.row;i++){
            $("<tr class='row' id="+(i+1)+"></tr>").appendTo($board);
            for(let v=0;v < this.col;v++){
                $("<td class='field' id="+t+"></td>").appendTo($($board).children().last());
                t+=1;
            }
        }
        $("<tr id='toolBar'><td id='startC' colspan='5'><h3 id='start'>START</h3></td><td id='restartC' colspan='5'><h3 id='restart'>RESTART</h3></td></tr>").appendTo($board);
        for(let i=0;i<100;i++){
            $("tr.row td#"+[i]+".field").slideUp(1);
        }
        
        let bool = false;
        $(".row").each(function() {
            if(bool){
                bool = false;
            } else{
                bool = true;
            }
            if(!bool){
                $(this).find(".field:even").css("background-color","gray").css("border-color","gray");
                $(this).find(".field:odd").css("background-color","orange").css("border-color","orange");
            } else {
                $(this).find(".field:even").css("background-color","orange").css("border-color","orange");
                $(this).find(".field:odd").css("background-color","gray").css("border-color","gray");
            }
        });
        console.log(this.minePosition)
        console.log(this.field)
    }

}

class Game{
    active = false;
    flagCounter = 0;
    flagPosition = [];
    uncoverCells = [];
    time = 0;
    timer = 0;
    timerBy3 = 0;

    constructor(){
        this.setTimer();
        $('tr#infoBar td h3#timer').text(this.timer);
        this.flagCounter = 0;
        this.flagPosition = [];
        this.uncoverCells = [];
    }

    gameEnd(){
        $("td.field").animate({
            opacity: [ 0.3, "linear" ]
        },200)
        $("div.playing").attr("class","loser");
        $("div.loser h3").text("LOSER");
        $("tr#toolBar td#stopC").off();
        gameController.top5Dialog();
        this.active = false;
    }

    uncoverCell(id,minePosition,field){
        if(!this.flagPosition.includes(id) && this.active == true){
            if(!this.uncoverCells.includes(id)){
                if(minePosition.includes(id)){
                    for(let i=0;i<minePosition.length;i++){
                        $("#board tr.row td#"+minePosition[i]).css("background-color","red").fadeIn(500);
                    }
                    this.gameEnd();
                } else if(field[id] != 0){
                    $("<a>"+field[id]+"</a>").appendTo($("#board tr.row td#"+id));
                    $("#board tr.row td#"+id).css("background-color","black").fadeIn(500);
                    this.uncoverCells.push(id);
                }else if(!this.uncoverCells.includes(id)) {
                    this.uncoverCells.push(id);
                    $("#board tr.row td#"+id).css("background-color","rgb(43, 43, 43)").fadeIn(500);
                    var around = [-11,-10,-9,-1,1,9,10,11];
                    var leftWing = [0,10,20,30,40,50,60,70,80,90];
                    var rightWing = [9,19,29,39,49,59,69,79,89,99];
                    for(let v=0;v<around.length;v++){
                        if(leftWing.includes(id) && !rightWing.includes(id+around[v])){
                            if(!((id+around[v]) > 99) && !((id+around[v]) < 0)){
                                if(!this.uncoverCells.includes(id+around[v])){
                                    this.uncoverCell(id+around[v],minePosition,field);
                                }
                            }
                        } else if(rightWing.includes(id) && !leftWing.includes(id+around[v])){
                            if(!((id+around[v]) > 99) && !((id+around[v]) < 0)){
                                if(!this.uncoverCells.includes(id+around[v])){
                                    this.uncoverCell(id+around[v],minePosition,field);
                                }
                            }
                        } else if(!((id+around[v]) > 99) && !((id+around[v]) < 0) && !leftWing.includes(id) && !rightWing.includes(id)){
                            if(!this.uncoverCells.includes(id+around[v])){
                                this.uncoverCell(id+around[v],minePosition,field);
                            }
                        }
                    }
                }
            }
        }
    }

    setFlag(id){
        if(!this.flagPosition.includes(id) && this.flagPosition.length < 10 && !this.uncoverCells.includes(id) && this.active){
            this.flagPosition.push(id)
            $("<img id='"+this.flagPosition.length+"' class='flag' src='images/flag.png' style='width: 90%;'>").appendTo($("tr.row td#"+id+".field")).hide(0).toggle(300);
            $("td#flags h3#flags").text(10-this.flagPosition.length);
        } else if(this.flagPosition.includes(id) && this.active){
            this.flagPosition.splice(this.flagPosition.indexOf(id),1);
            $("tr.row td#"+id+" img").toggle(300);
            setTimeout(function(){$("tr.row td#"+id+" img").remove();},310);
            $("td#flags h3#flags").text(10-this.flagPosition.length);
        }
    }

    setTimer(){
        let self = this;
        setInterval(function() {
            if(self.active == true  && !(self.time > 300)){
                self.time += 1;
                self.timerBy3 += 1;
            }
            if(self.timerBy3 == 3 && self.active == true ){
                self.timerBy3 = 0;
                if(self.active == true && !(self.timer > 100)){
                    self.timer += 1;
                    $("#progressbar").progressbar({
                        value: self.timer
                    });
                } else if(self.timer > 100){
                    self.gameEnd();
                    self.timer += 1;
                }
            }
            if(!self.uncoverCells.includes(builder.minePosition) && self.uncoverCells.length >= 90 && self.active != false){
                gameController.top5Dialog(self.time);
                $("div.playing").attr("class","winner");
                $("div.winner h3").text("WINNER");
                $("tr#toolBar td#stopC").off();
                self.active = false;
                $("td.field").animate({
                    opacity: [ 0.3, "linear" ]
                },100)
            }
        }, 1000);
    }
}

class Controller{    

    constructor(builder,game){
        $(document).contextmenu(function(event){
            event.preventDefault();
            return false;
        });

        builder.createTable();

        $("#board tr td.field").each(function(){
            $(this).contextmenu(function(){
                game.setFlag(parseInt(this.id),builder.minePosition,builder.field);
            });
        });

        $("#board tr td.field").each(function(){
            $(this).click(function(){
                game.uncoverCell(parseInt(this.id),builder.minePosition,builder.field)
            });
        });
                
        $("tr#toolBar td#startC").click(function(){
            game.active = true;
            builder.buildField();
            $("tr#toolBar td#startC h3").text("STOP");
            $("tr#toolBar td#startC").attr("id","stopC");
            buttonSSR();
        });

        function buttonSSR(){
            $(this).off()
            $("tr#toolBar td#startC").click(function(){
                game.active = true;
                builder.buildField();
                $("tr#toolBar td#startC h3").text("STOP");
                $("tr#toolBar td#startC").attr("id","stopC");
                buttonSSR();
            });
            $("tr#toolBar td#stopC").click(function(){
                game.active = false;
                $("tr#toolBar td#stopC h3").text("RESUME");
                $(this).attr("id","resumeC");
                buttonSSR();
            });
            $("tr#toolBar td#resumeC").click(function(){
                game.active = true;
                $("tr#toolBar td#resumeC h3").text("STOP");
                $(this).attr("id","stopC");
                buttonSSR();
            });
        }


        $("tr#toolBar td#restartC").click(function(){
            let $button = $("tr#toolBar td");
            if($($button[0]).attr('id') != "startC"){
                $("div.loser h3").text("");
                $("div.winner h3").text("");
                $("div.winner").attr("class","playing");
                $("div.loser").attr("class","playing");
                let bool = false;
                $(".row").each(function() {
                    $(this).find(".field a").remove();
                    $(this).find(".field img").remove();
                    if(bool){
                        bool = false;
                    } else{
                        bool = true;
                    }
                    if(!bool){
                        $(this).find(".field:even").css("background-color","gray").css("border-color","gray");
                        $(this).find(".field:odd").css("background-color","orange").css("border-color","orange");
                    } else {
                        $(this).find(".field:even").css("background-color","orange").css("border-color","orange");
                        $(this).find(".field:odd").css("background-color","gray").css("border-color","gray");
                    }
                });

                builder.minePosition = [];
                builder.field = [];
                game.flagCounter = 0;
                game.flagPosition = [];
                game.timer = 0;
                game.time = 0;
                $('tr#infoBar td h3#timer').text(game.timer);
                game.uncoverCells = [];
                $("td#flags h3#flags").text(10-game.flagPosition.length);

                
                if($($button[0]).attr('id') == "stopC"){
                    game.active = true;
                    buttonSSR();
                } else if($($button[0]).attr('id') == "resumeC"){
                    game.active = true;
                    $("tr#toolBar td#resumeC h3").text("STOP");
                    $($button[0]).attr("id","stopC");
                    buttonSSR();
                }
                builder.buildField();
                $("td.field").animate({
                    opacity: [ 1, "linear" ]
                },200)
            }
        });
    }    

    top5Dialog(timer = 1000){
        if(timer != 1000){
            let addLS = "";
            if('top5' in localStorage){
                let top5 = localStorage.getItem('top5').split(";");
                let introduced = false;
                top5.push(timer);
                for(let i=0;i<top5.length;i++){
                    top5[i] = parseInt(top5[i]);
                }
                top5.sort(function(a, b) {
                    return a - b;
                });
                if(top5.length > 5){ 
                    console.log("hola")
                    top5.pop()};
                for(let i=0;i<top5.length;i++){
                    /*if(timer <= top5[i] && !introduced){
                        top5.splice(i, 0, timer)
                        if(top5.length > 5){ top5.pop()};
                        introduced = true;
                    } else if(top5.length < 5 && !introduced && timer <= top5[i]){
                        top5.push(timer);
                        introduced = true;
                    }*/
                    console.log(top5);
                    if(i == 0){
                        addLS = top5[i];
                    } else {
                        addLS += (";"+top5[i]);
                    }
                }
                localStorage.setItem('top5',addLS);
            } else if(timer != 333){
                localStorage.setItem('top5',timer);
            }
        } 

        setTimeout(function(){
        $('div.dialog').css('border','1px solid rgb(255, 231, 13)').css('background-color','rgb(37, 37, 37)');
        $('button.ui-button').css("background-color",'rgb(37, 37, 37)').css('color','red').text("X");
        $('div.ui-dialog').css('background-color','rgb(37, 37, 37)');   
        },100);
        $("h3.titleL").remove();
        $("h3.title").remove();
        $("<h3 class='title'>TOP 5</h3><h3 class='titleL' style='margin-top: -25px;'>________________________________</h3>").appendTo($('div.dialog'));
        if('top5' in localStorage){ 
            $("h3.NY").remove();
            $("h3.top1").remove();
            $("h3.top2").remove();
            $("h3.top3").remove();
            $("h3.top4").remove();
            $("h3.top5").remove();
            $("h3.top5").remove();
            let top5 = localStorage.getItem('top5').split(";");
            var introduced = false;
            for(let i=0;i<top5.length;i++){
                if(timer == top5[i] && !introduced){
                    $("<h3 class='top"+(i+1)+"'>"+(i+1)+".  "+top5[i]+"s <-----</h3>").appendTo($('div.dialog'));
                } else {
                    $("<h3 class='top"+(i+1)+"'>"+(i+1)+".  "+top5[i]+"s</h3>").appendTo($('div.dialog'));
                }
            }

        } else {
            $("h3.NY").remove();
            $("<h3 class='NY'>NOT YET</h3>").appendTo($('div.dialog'));
        }
        
        $(function() {
            $(".dialog").dialog();
        })
    }
}

var builder = new Builder(10,10);
var game = new Game();
var gameController = new Controller(builder,game);
