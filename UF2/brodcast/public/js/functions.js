
$(document).ready(()=>{
    var script_tag = document.getElementById('functions');
    var user_id = script_tag.getAttribute("user-id");
    function publicChannel(){
        console.log("welcome to public channel")
        Echo.private("_public_channel_")
        .listen('NewMessageNotification', (e) => {
            console.log(e.message)
            $("#walls").prepend("<div class='wallBlock'><p>"+e.message.from+": "+e.message.message+"</p></div>");
        });
    
    }
    publicChannel();
    $("#send").click(function(event){
        event.preventDefault();

        var _token = $('meta[name=csrf-token]').attr('content');
        var message = $("#message").val();
        var to = $("#channel").val();
        var from = user_id;
        $.ajax({
            url: "http://dawjavi.insjoaquimmir.cat/jfuentes/UF2/brodcast/public/facebook",
            type:'POST',
            data: {_token:_token, message:message, to:to,from:from},
            success: function(data) {
                $("#walls").prepend("<div class='wallBlock'><p>You: "+message+"</p></div>");
                $("#message").val("");
            }
        })
        return false;
    })
    
    $('#channel').change(function(){
        Echo.leave();
        if($('#channel').val() != "_public_channel_"){
            console.log("welcome to user."+user_id+"channel")
            Echo.private('user.'+user_id)
            .listen('NewMessageNotification', (e) => {
                console.log(e.message)
                $("#walls").prepend("<div class='wallBlock'><p>"+e.message.from+": "+e.message.message+"</p></div>");
            });
        } else {
            publicChannel();
        }
    });
  
})