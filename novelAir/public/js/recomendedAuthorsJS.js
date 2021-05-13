$('document').ready(function(){
    
    //Buscador avanzado
    if ($('#checkAuthors').is(':checked')){
        $('#inputdivAuthors').show();
    }else{
        $('#inputdivAuthors').hide();
    }

    $('#checkAuthors').click(function(){
        if ($('#checkAuthors').is(':checked')){
            $('#inputdivAuthors').show(700);
        }else{
            $('#inputdivAuthors').hide(700);
        }
    })

    jQuery(document).ready(function($){
        $(document).ready(function() {
            $('.mi-selector').select2();
        });
    });

});