$('#right').click(function() {
    var toChange = $('#listL').val()
    for (var i=0;i<toChange.length;i++){
        $('<option value="'+toChange[i]+'">alumne '+toChange[i]+'</option>').prependTo($('#listR'))


        $('#listL option').each(function() {
            if ($(this).val() == toChange[i]){
                $(this).remove();
            }
        })
    }
});

$('#left').click(function() {
    var toChange = $('#listR').val()
    for (var i=0;i<toChange.length;i++){
        $('<option value="'+toChange[i]+'">alumne '+toChange[i]+'</option>').prependTo($('#listL'))


        $('#listR option').each(function() {
            if ($(this).val() == toChange[i]){
                $(this).remove();
            }
        })
    }

});