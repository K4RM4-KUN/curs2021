//A2 
var activites = $("#schedule");
var buttonA = $(".add");
var buttonO = $(".search-button");
var buttonX = $(".X");
var inputS = $(".search-input")
var dateT = $(".dateV");
var nameT =  $(".nameV");

buttonA.click(function(){
    let randString = randomString(10);
    let add = "<table class='activites'><tr><td class='date'><text>"+$(dateT).val()+"</text></td><td class='name'><text>"+$(nameT).val()+"</text></td><td class='X'>X<input type='hidden'value="+randString+"></td></tr></table>";
    localStorage.setItem(randString,add);
    $(add).appendTo($("#schedule"));
    console.log(things);
});

$("#schedule").on("click",'.X' ,function() {
  var parent = $(this).parent().parent().parent().remove();
  localStorage.removeItem($(this).children().val());
});

//A3 Buscador

buttonO.click(function(){
  let search = $(inputS).val().toUpperCase();
  let name = $(".name text");
  for(let i=0;i<$(name).length;i++){
    let text = $(name)[i].innerHTML.toUpperCase();
    if(text.indexOf(search) != -1 && search != ""){
      $(name[i]).parent().parent().css('background-color','yellow');
    } else {
      $(name[i]).parent().parent().css('background-color','white');
    }
  }
});

//A4 Local Storage

function randomString(length){
  chars = "0123456789abcdefghijklmnopqrstuvwxyz";

  var string = "";
  var max = chars.length-1;
  for (var i = 0; i<length; i++) {
    string += chars[ Math.floor(Math.random() * (max+1)) ];
  }
  return string;
}

for(let i=0;i<localStorage.length;i++){
  let value = localStorage.getItem(localStorage.key(i));
  $("#schedule").append(value);
}