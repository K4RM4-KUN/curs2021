
var script_tag = document.getElementById('functions');
var user_id = script_tag.getAttribute("user-id");
var user_name = script_tag.getAttribute("user-name");

function public(){
    Echo.private("_public_channel_")
    .listen('publicWall', (e) => {
        let name = "";
        $("#channel option").each(function(){
            if ($(this).val() == e.message.from){        
                name = $(this).text();
                $("#walls").prepend("<div class='wallBlock'><p>"+name+": "+e.message.message+"</p></div>");
            }
        });
    })
    .listenForWhisper('typing', (e) => {
        $('.typing').text(e.user + " esta escribiendo...")
        e.typing ? $('.typing').show() : $('.typing').hide()
        setTimeout( () => {
            $('.typing').hide()
        }, 5000)
    });
}

$(document).ready(()=>{
    //Public(General PrivateChannel) channel connection
    public();

    //If is typing build
    $('input').on('keydown', function(){
        let channel = Echo.private('_public_channel_')
        setTimeout( () => {
            channel.whisper('typing', {
                user: user_name,
                typing: true
            })
        }, 1500)
    })

    //Channels listening build
    $('#channel').change(function(){
        if($('#channel').val() != "_public_channel_"){
            Echo.leave("_public_channel_");
            $.get("http://dawjavi.insjoaquimmir.cat/mboughima/Clase/M07/UF2UF3/boradPuser/public/getMsg/"+$("#channel").val(), (response)=>{
                console.log($(response));
                $("#walls").children().remove();
                $("#walls").html($(response).find(".msg"))
            })
            Echo.private("user."+user_id)
            .listen('NewMessageNotification', (e) => {
                let name = "";
                $("#channel option").each(function(){
                    if ($(this).val() == e.message.from){        
                        name = $(this).text();
                        $("#walls").prepend("<div class='wallBlock'><p>"+name+": "+e.message.message+"</p></div>");
                    }
                });
            })
            .listenForWhisper('typing', (e) => {
                console.log("hola===");
                console.log(e.name);
            });
        } else {
            //Public(General PrivateChannel) channel connection
            Echo.leave("user."+user_id);
            public();
        }
    });
  
    //Send message button build
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
})