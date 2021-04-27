$(document).ready(function(){
  // Esdeveniment click botó
  $("#add-container").on("click","button",function() {

    var valor = $("#add-container input").val();
    console.log(valor);

    var content,
        randomBool = Math.random() < 0.5;

    if (randomBool) {
      // Versió amb HTML

      // ----------
      // Estructura
      // ----------
      var html ='<div class="item">\
      <div class="remove">X</div>' + valor + '</div>';
      console.log("-> Versió HTML");
      content = html;
    } else {
      // Versió amb DOM

      // ----------
      // Estructura
      // ----------
      var $div1 = createElementV2("div", null, "item");
      $div1.html(valor);
      var $div2 = createElementV2("div", null, "remove");
      $div2.html("X");
      $div1.prepend($div2);
      console.log("-> Versió DOM");
      content = $div1;
      
      // ------------
      // Esdeveniment
      // ------------
      // No cal crear l'esdeveniment perquè es delega al pare (veure més endavant).
      /*$div2.click(function(){
        var parent = $(this).parent().remove();
      });*/
    }

    // Afegim HTML / DOM
    $('#places-container').append(content);

    // $(html).appendTo("#places-container");

    // $('#places-container').prepend(html);
    // $(html).prependTo("#places-container");

    //$("#places-container").children().last().after(html);
    // $("#places-container").children().first().before(html);
  });
});

// -------------
// Esdeveniments
// -------------
// Delegació d'esdeveniments. L'esdeveniment s'estableix a l'element superior que ha existit "sempre"
// I es delega a l'element indicat com a segon paràmetre
$("#places-container").on("click",'.remove' ,function() {
  var parent = $(this).parent().remove();
});
// Aquesta versió no funciona bé ja que si creem elements, com que no existien en el moment 
// de crear l'esdeveniment, els nous elements agregats no tindran esdeveniment!
/*$("#places-container .remove").on("click",function() {
    var parent = $(this).parent().remove();
});*/


// ------------------
// Funcions auxiliars
// ------------------
function createElementV1 (tag, id, className) {
  var newdiv1 = document.createElement(tag);
  if (id) {
    newdiv1.id = id;
  }
  if (className) {
    newdiv1.classList.add(className);
  }

  return newdiv1;
}

function createElementV2 (tag, id, className) {
  var $newdiv2 = $("<"+tag+"></"+tag+">");
  if (id) {
    $newdiv2.attr("id", id);
  }
  if (className) {
    $newdiv2.addClass(className);
  }

  return $newdiv2;
}