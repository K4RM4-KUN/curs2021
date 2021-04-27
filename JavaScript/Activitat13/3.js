$('#enun').click(function() {
    if($("#province").attr('disabled')){
        $("#province").removeAttr('disabled').attr('placeholder','Enabled');
    } else {
        $("#province").attr('disabled','disabled').attr('placeholder','Disabled');
    }
});

$('#delete').click(function() {
    $('#name').val("");
    $('#province').val("");
});