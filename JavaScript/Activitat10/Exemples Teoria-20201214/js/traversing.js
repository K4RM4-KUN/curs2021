$(document).ready(function() {


    var $resultat = $("#animals .criatures"); 
    console.log($resultat);
     
    $resultat = $("#animals").find(".criatures");
    console.log($resultat);
    
    ////////

    $resultat = $("#animals > *");
    console.log($resultat);

    $resultat = $("#animals").children(); 
    console.log($resultat);

    ///////// El mateix a continuació, pero especificant un selector

    $resultat = $("#animals > div");
    console.log($resultat);

    $resultat = $("#animals").children("div"); 
    console.log($resultat);

    // Recorrent
    $resultat = $("#animals").children().first()
        .children(".criatures").last();
    console.log($resultat);

    $resultat = $("#animals").children().first()
        .children().last().prev().prev();
    console.log($resultat);

    $resultat = $("#animals").children().first()
        .children().first().next()
    console.log($resultat);


    $resultat = $("#gat").parent();
    console.log($resultat);

    $resultat = $("#gat").parents();
    console.log($resultat);








});

