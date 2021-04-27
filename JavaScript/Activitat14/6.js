//Form's var's
var title = $('#titleInput');
var sendButton = $("#submit");
var description = $('#descriptionInput');

//Functions

$(document).ready(function(){

    //Send button build
    sendButton.click(function(){
        localStorage.setItem('title',$(title).val());
        localStorage.setItem('description',$(description).val());
    });

});