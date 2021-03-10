var script_tag = document.getElementById('functions');
var user_id = script_tag.getAttribute("user-id");
var user_name = script_tag.getAttribute("user-name");

$(document).ready(()=>{
    $(".buttonLike").each(function(){
        if($(this).hasClass("disabled") == true){
            $(this).val($(this).val().charAt(0)+" Dislike");
        } else {
            $(this).val($(this).val().charAt(0)+" Like");
        }
    })

    //Public(General PrivateChannel) channel connection
    function public(){
        Echo.private("_public_channel_")
        .listen('publicWall', (e) => {
            let name = "";
            $("#channel option").each(function(){
                if ($(this).val() == e.message.from){        
                    name = $(this).text();
                    $("#walls center").prepend('<div class="wallBlock"><p>'+name+': '+e.message.message+'</p></div><input type="text" class="postId" value="'+0+'" hidden><input class="buttonLike" type="button" value="0 Like"><input class="buttonComment" type="button" value="Show 0 Comments"><div class="comments" hidden><input type="text" class="comm" placeholder="Comment..."><input class="buttonCommentGo" type="button" value="Comment"></div></div>');
                    $("#message").val("");$("#imageUp").val("");
                    buttons();
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
        Echo.join("_public_channel_")
        .here((users) => {
            users.forEach(element=>{
                $("#connecteds center").append("<p id='"+element.id+"-conn'>·"+element.name+"</p>")
            })
        })
        .joining((user) => {
            $("#connecteds center").append("<p id='"+user.id+"-conn'>·"+user.name+"</p>")
        })
        .leaving((user) => {
            console.log(user.name)
            $("#connecteds").children("center").children("#"+user.id+"-conn").remove();
        });
    }

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
                        $("#walls center").prepend("<div class='wallBlock'><input type='text' class='postId' value='"+e.message.id+"' hidden><p>"+name+": "+e.message.message+"</p></div>");
                        $(".wallBlock").eq(0)
                        .append('<input type="text" class="postId" value="'+0+'" hidden><input class="buttonLike" type="button" value="0 Likes"><input class="buttonComment" type="button" value="Show Comments"><div class="comments" hidden><input type="text" class="comm" placeholder="Comment..."><input class="buttonCommentGo" type="button" value="Comment"></div>');
                        $("#message").val("");$("#imageUp").val("");
                        buttons();
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
        //var img = $("#imageUp").val()
        $.ajax({
            url: "http://dawjavi.insjoaquimmir.cat/jfuentes/UF2/brodcast/public/facebook",
            type:'POST',
            data: {_token:_token, message:message, to:to,from:from},
            success: function(data) {
                $("#walls center").prepend("<div class='wallBlock'><p>You: "+message+"</p></div>");
                $(".wallBlock").eq(0)
                .append('<input type="text" class="postId" value="'+data.message_id+'" hidden><input class="buttonLike" type="button" value="0 Likes"><input class="buttonComment" type="button" value="Show Comments"><div class="comments" hidden><input type="text" class="comm" placeholder="Comment..."><input class="buttonCommentGo" type="button" value="Comment"></div>');
                $("#message").val("");$("#imageUp").val("");
                buttons();
            }
        })
        return false;
    })

    function buttons(){
    //Like button build    
    $(".buttonLike").click(function(){
        var save = $(this);
        var _token = $('meta[name=csrf-token]').attr('content');
        var id = $(this).parent().children(".postId").val();
        console.log(id);
        $.ajax({
            url: "http://dawjavi.insjoaquimmir.cat/jfuentes/UF2/brodcast/public/like",
            type:'POST',
            data: {_token:_token, postId:id, userId:user_id},
            success: function(data) {
                if($(save).hasClass("disabled") == false){
                    $(save).val((parseInt(($(save).val().charAt(0)))+1)+" Dislike");
                    $(save).addClass("disabled");
                } else {
                    $(save).val((parseInt(($(save).val().charAt(0)))-1)+" Like");
                    $(save).removeClass("disabled");
                }
            }
        })
        return false;
    })

    //Comment button build
    $(".buttonComment").click(function(){ 
        if($(this).parent().children(".comments").is(":visible")){
            $(this).css("background-color","white").css("color","black");
        } else {
            $(this).css("background-color","#585858").css("color","white");
        }
        $(this).parent().children(".comments").toggle();
    })

    $(".buttonCommentGo").click(function(){ 
        var save = $(this);
        var _token = $('meta[name=csrf-token]').attr('content');
        var id = $(this).parent().parent().children(".postId").val();
        var comment = $(this).parent().children(".comm").val();
        $.ajax({
            url: "http://dawjavi.insjoaquimmir.cat/jfuentes/UF2/brodcast/public/comment",
            type:'POST',
            data: {_token:_token, postId:id, userId:user_id, comment:comment},
            success: function(data) {
                $(save).parent().children(".comm").val("")
                $(save).parent().append("<div><p>You: "+comment+"</p></div>");
            }
        })
        return false;
    })

    }

    buttons();


})