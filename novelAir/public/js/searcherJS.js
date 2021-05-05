$('document').ready(function(){

    $('.tagsDiv').hide();
    
    $('#filtrarTag').click(function(){
        if ($('#filtrarTag').is(':checked')){
            $('.tagsDiv').show(700);
        }else{
            $('.tagsDiv').hide(700);
        }
    })
});