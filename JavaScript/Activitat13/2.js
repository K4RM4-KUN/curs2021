$('#test').click(function() {
    $("#group1").val($('input:radio[name=rad1]:checked').val());
    $("#group2").val($('input:radio[name=rad2]:checked').val());
});