$('#send').click(function() {
    var splited = $('#name').val().split(" ");
    if(!(splited.Length() < 2)){

    } 
    $( "#myform" ).validate({
        rules: {
          age: {
            required: true,
            min: 18,
            max:99
          }
        }
      });
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if(emailRegex.test($('#email').val())) {
        
    }

    emailRegex = /^#+\w+/i;
    if(emailRegex.test($('#explain').val()) && !$('#explain').val().contains("bobo") && !$('#explain').val().contains("tonto")) {
        
    }
});


$('#delete').click(function() {
    $('#name').val("");
    $('#age').val("");
    $('#email').val("");
    $('#explain').val("");
});