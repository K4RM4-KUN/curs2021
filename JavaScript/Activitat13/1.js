/*JS without JQUERY*//*
document.addEventListener("DOMContentLoaded", function(){
    var chk1Content = ["Usted no es: adulto","Usted es: adulto",0]
    var chk2Content = ["Usted no es: unversitario","Usted es: unversitario",0]
    var chk3Content = ["Usted no es: soltero","Usted es: soltero",1]
    document.getElementById('chk1').addEventListener("click",function(){
        if(document.getElementById('chk1').checked){
            chk1Content[2] = 1
        } else {
            chk1Content[2] = 0
        }
        document.getElementById('result').innerHTML = (chk1Content[chk1Content[2]]+"\n"+chk2Content[chk2Content[2]]+"\n"+chk3Content[chk3Content[2]]);
    });
    document.getElementById('chk2').addEventListener("click",function(){
        if(document.getElementById('chk2').checked){
            chk2Content[2] = 1
        } else {
            chk2Content[2] = 0
        }
        document.getElementById('result').innerHTML = (chk1Content[chk1Content[2]]+"\n"+chk2Content[chk2Content[2]]+"\n"+chk3Content[chk3Content[2]]);
    });
    document.getElementById('chk3').addEventListener("click",function(){
        if(document.getElementById('chk3').checked){
            chk3Content[2] = 1
        } else {
            chk3Content[2] = 0
        }
        document.getElementById('result').innerHTML = (chk1Content[chk1Content[2]]+"\n"+chk2Content[chk2Content[2]]+"\n"+chk3Content[chk3Content[2]]);
    });
    document.getElementById('test').addEventListener("click",function(){
        document.getElementById('result').innerHTML = (chk1Content[chk1Content[2]]+"\n"+chk2Content[chk2Content[2]]+"\n"+chk3Content[chk3Content[2]]);
    });

});
*/
/*JQUERY*/
$(document).ready(function(){
    var chk1Content = ["Usted no es: adulto","Usted es: adulto",0]
    var chk2Content = ["Usted no es: unversitario","Usted es: unversitario",0]
    var chk3Content = ["Usted no es: soltero","Usted es: soltero",1]
    $('#chk1').click(function(){
        if($('#chk1').is(':checked')){
            chk1Content[2] = 1
        } else {
            chk1Content[2] = 0
        }
        $('#result').text(chk1Content[chk1Content[2]]+"\n"+chk2Content[chk2Content[2]]+"\n"+chk3Content[chk3Content[2]]);
    });
    $('#chk2').click(function(){
        if($('#chk2').is(':checked')){
            chk2Content[2] = 1
        } else {
            chk2Content[2] = 0
        }
        $('#result').text(chk1Content[chk1Content[2]]+"\n"+chk2Content[chk2Content[2]]+"\n"+chk3Content[chk3Content[2]]);
    });
    $('#chk3').click(function(){
        if($('#chk3').is(':checked')){
            chk3Content[2] = 1
        } else {
            chk3Content[2] = 0
        }
        $('#result').text(chk1Content[chk1Content[2]]+"\n"+chk2Content[chk2Content[2]]+"\n"+chk3Content[chk3Content[2]]);
    });
    $('#test').click(function(){
        $('#result').text(chk1Content[chk1Content[2]]+"\n"+chk2Content[chk2Content[2]]+"\n"+chk3Content[chk3Content[2]]);
    });
});