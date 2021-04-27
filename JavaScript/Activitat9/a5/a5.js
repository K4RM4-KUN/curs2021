/*A*/$("div.module").css("font-size",100).css("text-align","center");
/*B*/$("a:odd").attr("href","http://www.informatica.iesjoaquimmir.cat");
/*C*/$("a:last").html("PAGINA CANVIADA");
/*C2*/$("a:last-child").html("PAGINA CANVIADA");
/*D*/$("a:first").css("color","red");
/*D2*/$("a:first-child").css("color","red");
/*E*/$("ul li").filter(".current").css("color","yellow");
/*F*/$("div.F").css("font-size",20).css("background-color","lightblue");
/*G*/$("div:not('[class]')").css("font-size",20).css("background-color","lightgray").addClass("complet");
    /*8*/
        let $li = $("ul.G8 li");
        for(let i=0;i<$("ul.G8 li").length;i++){
            $($li[i]).text("Element "+(i+1));
        }
    /*9*/
        let $li9 = $("ul.G9 li");
        for(let i=0;i<$($li9).length;i++){
            $($li9[i]).text("Element "+Math.floor(Math.random() * 10));
        }
    /*10*/
        alert("LI's: "+$("li").length);
    /*11*/
        let $t10 = $("table.G10 tr td");
        $t10.css("background-color0","red");
        $($t10[Math.floor(Math.random() * $($t10).length)]).css("background-color0","red");
    /*12*/
    /*13*/
    /*14*/