$('document').ready(function(){
    
    //Buscador avanzado
    if ($('#more').is(':checked')){
        $('#moreDiv').show();
    }else{
        $('#moreDiv').hide();
    }

    $('#more').click(function(){
        if ($('#more').is(':checked')){
            $('#moreDiv').show(700);
        }else{
            $('#moreDiv').hide(700);
        }
    })

    //Tipo de novela
    if ($('#all').is(':checked')){
        $('#novelVisualType').hide();
    }else{
        $('#novelVisualType').show();
    }
    
    $('#all').click(function(){
        if ($('#all').is(':checked')){
            $('#novelVisualType').hide(700);
        }else{
            $('#novelVisualType').show(700);
        }
    })

    //Finalizado
    if ($('#bothE').is(':checked')){
        $('#finished').hide();
    }else{
        $('#finished').show();
    }
    
    $('#bothE').click(function(){
        if ($('#bothE').is(':checked')){
            $('#finished').hide(700);
        }else{
            $('#finished').show(700);
        }
    })

    //+18
    if ($('#both').is(':checked')){
        $('#18div').hide();
    }else{
        $('#18div').show();
    }
    
    $('#both').click(function(){
        if ($('#both').is(':checked')){
            $('#18div').hide(700);
        }else{
            $('#18div').show(700);
        }
    })
    
    
    //Filtro de tags
    if ($('#filtrarTag').is(':checked')){
        $('.tagsDiv').show();
    }else{
        $('.tagsDiv').hide();
    }
    
    $('#filtrarTag').click(function(){
        if ($('#filtrarTag').is(':checked')){
            $('.tagsDiv').show(700);
        }else{
            $('.tagsDiv').hide(700);
        }
    })
});