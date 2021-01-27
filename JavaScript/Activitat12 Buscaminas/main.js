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
        $("<tr id='infoBar'><td colspan='5'><h3 id='timer'></h3></td><td  id='flags' colspan='5'><h3 id='flags'>10</h3></td></tr>").appendTo($board);
        for(let i=0;i < this.row;i++){
            $("<tr class='row' id="+(i+1)+"></tr>").appendTo($board);
            for(let v=0;v < this.col;v++){
                $("<td class='field' id="+t+"></td>").appendTo($($board).children().last());
                t+=1;
            }
        }
        $("<tr id='toolBar'><td id='startC' colspan='5'><h3 id='start'>START</h3></td><td id='restartC' colspan='5'><h3 id='restart'>RESTART</h3></td></tr>").appendTo($board);
        
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

    constructor(){
        this.flagCounter = 0;
        this.flagPosition = [];
        this.uncoverCells = [];
    }

    uncoverCell(id,minePosition,field){
        //console.log(field)
        if(!this.flagPosition.includes(id) && this.active){
            if(!this.uncoverCells.includes(id)){
                if(minePosition.includes(id)){
                    console.log("BOOOOOM!!!");
                } else if(field[id] != 0){
                    $("<a>"+field[id]+"</a>").appendTo($("#board tr.row td#"+id));
                    $("#board tr.row td#"+id).css("background-color","black");
                    this.uncoverCells.push(id);
                }else if(!this.uncoverCells.includes(id)) {
                    this.uncoverCells.push(id);
                    $("#board tr.row td#"+id).css("background-color","rgb(43, 43, 43)");
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
            $("<img src='images/flag.png' style='width: 90%;'>").appendTo($("tr.row td#"+id+".field"));
            $("td#flags h3#flags").text(10-this.flagPosition.length);
        } else if(this.flagPosition.includes(id)){
            this.flagPosition.splice(this.flagPosition.indexOf(id),1);
            $("tr.row td#"+id+" img").remove();
            $("td#flags h3#flags").text(10-this.flagPosition.length);
        }
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

    }    

}

var builder = new Builder(10,10);
var game = new Game();
var gameController = new Controller(builder,game);

$("tr#toolBar td#startC").click(function(){
    builder.active = true;
    builder.buildField();
    $("tr#toolBar td#startC h3").text("STOP");
    $("tr#toolBar td#startC").addClass("stopC");
    $("tr#toolBar td#startC").removeClass("startC");
});

$("tr#toolBar td#stopC").click(function(){
    builder.active = false;
    $("tr#toolBar td#stopC h3").text("RESUME");
    $("tr#toolBar td#stopC").addClass("resumeC");
    $("tr#toolBar td#stopC").removeClass("stopC");
});

$("tr#toolBar td#resumeC").click(function(){
    builder.active = true;
    $("tr#toolBar td#resumeC h3").text("STOP");
    $("tr#toolBar td#resumeC").addClass("stopC");
    $("tr#toolBar td#resumeC").removeClass("resumeC");
});



$("tr#toolBar td#restartC").click(function(){
    builder.minePosition = [];
    builder.field = [];
    builder.buildField();  
    game.uncoverCells = [];
});


