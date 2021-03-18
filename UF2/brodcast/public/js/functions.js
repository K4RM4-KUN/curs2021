var script_tag = document.getElementById('functions');
var user_id = script_tag.getAttribute("user-id");
var user_name = script_tag.getAttribute("user-name");
var src = "https://dawjavi.insjoaquimmir.cat/jfuentes/UF2/brodcast/public/img/";
var actualChannel = "_public_channel_"
$(document).ready(()=>{

    function checkGreater(to,from){
        var result = "";
        if(parseInt(to) < parseInt(from)){
            result = to+"."+from
        } else{
            result = from+"."+to
        }
        return result;
    }

    Echo.private('user.'+user_id)
    .listen('InstantNotify', (e)=>{
        let name = "";
        $("#channel option").each(function(){
            if ($(this).val() == e.from){        
                name = $(this).text();
            }
        });
        let bool = false;
        $("center.notifications .notification").each(function(){
            if($(this).text().split("-")[1] == name){
                bool = true;
            }
        })
        if(!bool){ 
            $("center.notifications").append('<p class="notification">-'+name+'-</p>');
            if($("#channel").val() == e.from){
                killNotifications();
            }
        } 
    })

    //Instant like & comment
    Echo.private('_reactions_')
    .listenForWhisper('reaction_entry', (e) => {
        //InstantLike
        if(e.type =="like_reaction"){
            let data = e;
            let save = undefined;
            let saveState = undefined;
            $(".postId").each(function(){
                if($(this).val() == data.id){
                    save = $(this).parent().children(".buttonLike");
                    saveState = $(save).val().split(" ");
                }
            })
            if(save != undefined){
                if(e.liked){
                    $(save).val((parseInt(($(save).val().charAt(0)))+1)+" "+saveState[1]);
                
                }else{
                    $(save).val((parseInt(($(save).val().charAt(0)))-1)+" "+saveState[1]);
                } 
            }
        }else{
            let data = e;
            let save = undefined;
            let saveState = undefined;
            $(".postId").each(function(){
                if($(this).val() == data.id){
                    save = $(this).parent().children(".buttonComment");
                    saveState = $(save).val().split(" ");
                }
            })
            $(save).val(saveState[0]+" "+(parseInt(saveState[1])+1)+" "+saveState[2]);
            $(save).parent().children(".comments").append("<div><p>"+e.name+": "+e.comment+"</p></div>");
        }
    })
    
    //Like status
    $(".buttonLike").each(function(){
        if($(this).hasClass("disabled") == true){
            $(this).val($(this).val().charAt(0)+" Dislike");
        } else {
            $(this).val($(this).val().charAt(0)+" Like");
        }
    })

    //Public(General PrivateChannel) channel connection
    function public(){
        actualChannel = "_public_channel_";
        Echo.private("_public_channel_")
        .listen('publicWall', (e) => {
            let name = "";
            $("#channel option").each(function(){
                if ($(this).val() == e.message.from){        
                    name = $(this).text();
                }
            });
            if(name == ""){
                name = "You";
            }
            if(e.message.img_route == undefined){
                $("#walls center").prepend("<div class='wallBlock'><input type='text' class='postId' value='"+e.message.id+"' hidden><p>"+name+": "+e.message.message+"</p></div>");
            } else{
                $("#walls center").prepend("<div class='wallBlock'><input type='text' class='postId' value='"+e.message.id+"' hidden><a href='https://dawjavi.insjoaquimmir.cat/jfuentes/UF2/brodcast/public/img/"+e.message.img_route+"' target='_blank'><img class='image' src='"+src+e.message.img_route+"' alt='image' width='45%'></a><p>"+name+": "+e.message.message+"</p></div>");
            }
            $(".wallBlock").eq(0).append('<input type="text" class="postId" value="'+e.message.id+'" hidden><input class="buttonLike" type="button" value="0 Like"><input class="buttonComment" type="button" value="Show 0 Comments"><div class="comments" hidden><input type="text" class="comm" placeholder="Comment..."><input class="buttonCommentGo" type="button" value="Comment"></div></div>');
            $("#message").val("");
            $("#imageUp").val("");
            buttons();
        })
        .listenForWhisper('typing', (e) => {
            $('.typing').text(e.user + " esta escribiendo...")
            e.typing ? $('.typing').show() : $('.typing').hide()
            setTimeout( () => {
                $('.typing').hide()
            }, 5000)
        });
    }

    //Presence channel connection
    function presence(){
        Echo.join("_presence_channel_")
        .here((users) => {
            users.forEach(element=>{
                $("#connecteds center.connecteds").append("<p class='con-user' id='"+element.id+"-conn'>·"+element.name+"</p>")
            })
        })
        .joining((user) => {
            $("#connecteds center.connecteds").append("<p class='con-user' id='"+user.id+"-conn'>·"+user.name+"</p>")
            let bool = false;
            $("#channel option").each(function(){
                if ($(this).val() == user.id){     
                    bool = true;
                }
            });
            if(!bool){
                $("#channel").append("<option value='"+user.id+"'>"+user.name+"</option>")
            }
        })
        .leaving((user) => {
            $("#connecteds").children("center.connecteds").children("#"+user.id+"-conn").remove();
        });
    }

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

    function killNotifications(){
        $("center.notifications .notification").each(function(){
            if($(this).text().split("-")[1] == $("#channel option:selected").text()){
                $(this).remove();
                var save = $(this);
                var _token = $('meta[name=csrf-token]').attr('content');
                $.ajax({
                    url: "https://dawjavi.insjoaquimmir.cat/jfuentes/UF2/brodcast/public/notification",
                    type:'POST',
                    data: {_token:_token, from_id:$('#channel').val(), to_id:user_id},
                    success: function(data) {
                    }
                })
            }
        })
    }

    //Channels listening build
    $('#channel').change(function(){
        Echo.leave("_public_channel_");
        if($('#channel').val() != "_public_channel_"){
            $("#walls center").empty(); 
            $("#upImage").attr("hidden",true);
            killNotifications();
            $.getJSON("https://dawjavi.insjoaquimmir.cat/jfuentes/UF2/brodcast/public/channelChange/"+$("#channel").val(), (response)=>{
                $.each( response, function() {
                    usersInfo = response.userName
                    response.old.map((data)=>{
                        let name = "";
                        let fal = false;
                        $("#channel option").each(function(){
                            if ($(this).val() == data.from){        
                                name = $(this).text();
                                fal = true;
                            }
                        });
                        if(!fal){
                            $("#walls center").prepend("<div class='wallBlock'><input type='text' class='postId' value='"+data.id+"' hidden><p>You: "+data.message+"</p></div>");
                        } else {
                            $("#walls center").prepend("<div class='wallBlock'><input type='text' class='postId' value='"+data.id+"' hidden><p>"+name+": "+data.message+"</p></div>");
                        }
                    })
                    return false;
                  });
                  if( $("#walls center").children().length == 0){
                    $("#walls center").prepend("<h1 id='nms'>No messages!</h1>")
                }
            })
            actualChannel = "user."+checkGreater($("#channel").val(),user_id);
            Echo.private("user."+checkGreater($("#channel").val(),user_id))
            .listen('NewMessageNotification', (e) => {
                if(e.message.from == parseInt($("#channel").val())){
                    let name = "";
                    $("#channel option").each(function(){
                        if ($(this).val() == e.message.from){        
                            name = $(this).text();
                            $("#nms").remove();
                            $("#walls center").prepend("<div class='wallBlock'><input type='text' class='postId' value='"+e.message.id+"' hidden><p>"+name+": "+e.message.message+"</p></div>");
                        }
                    });
                }
            })
            .listenForWhisper('typing', (e) => {
            });
        } else {
            //Public(General PrivateChannel) channel connection
            Echo.leave("user."+checkGreater($("#channel").val(),user_id));
            window.location.replace("https://dawjavi.insjoaquimmir.cat/jfuentes/UF2/brodcast/public/facebook");
        }
    });
  
    //Send message button build
    $("#send").click(function(event){
        event.preventDefault();
        let data = new FormData();
        data.append("_token", $('meta[name=csrf-token]').attr('content'));
        data.append("message", $("#message").val());
        data.append("to", $("#channel").val());
        data.append("channel", checkGreater($("#channel").val(),user_id));
        data.append("from", user_id);
        data.append("image", $("#imageUp").prop('files')[0]);
        $.ajax({
            type: "POST",
            url: "https://dawjavi.insjoaquimmir.cat/jfuentes/UF2/brodcast/public/facebook",
            data: data,
            processData: false,
            contentType: false,
            success: function(data) {
                if($("#channel").val() != "_public_channel_"){
                    $("#walls center").prepend("<div class='wallBlock'><p>You: "+$("#message").val()+"</p></div>");
                    $("#message").val("");$("#imageUp").val("");
                    var _token = $('meta[name=csrf-token]').attr('content');
                    $.ajax({
                        url: "https://dawjavi.insjoaquimmir.cat/jfuentes/UF2/brodcast/public/notifyUser",
                        type:'POST',
                        data: {_token:_token, to_id:$('#channel').val(), from_id:user_id},
                        success: function(data) {
                        }
                    })
                    $("#nms").remove();
                }
            },
            error: function(datab) {

            }
        });
        return false;
    })

    function buttons(){
    //Like button build    
    $(".buttonLike").click(function(){
        var save = $(this);
        var _token = $('meta[name=csrf-token]').attr('content');
        var id = $(this).parent().children(".postId").val();
        $.ajax({
            url: "https://dawjavi.insjoaquimmir.cat/jfuentes/UF2/brodcast/public/like",
            type:'POST',
            data: {_token:_token, postId:id, userId:user_id},
            success: function(data) {
                if($(save).hasClass("disabled") == false){
                    $(save).val((parseInt(($(save).val().charAt(0)))+1)+" Dislike");
                    $(save).addClass("disabled");
                    Echo.private('_reactions_').whisper('reaction_entry', {
                        id: id,
                        liked: true,
                        type: "like_reaction"
                    })
                } else {
                    $(save).val((parseInt(($(save).val().charAt(0)))-1)+" Like");
                    $(save).removeClass("disabled");
                    Echo.private('_reactions_').whisper('reaction_entry', {
                        id: id,
                        liked: false,
                        type: "like_reaction"
                    })
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
            url: "https://dawjavi.insjoaquimmir.cat/jfuentes/UF2/brodcast/public/comment",
            type:'POST',
            data: {_token:_token, postId:id, userId:user_id, comment:comment},
            success: function(data) {
                let show = $(save).parent().parent().children(".buttonComment");
                let showStates = $(show).val().split(" ");
                $(show).val(showStates[0]+" "+(parseInt(showStates[1])+1)+" "+showStates[2]);
                $(save).parent().children(".comm").val("")
                $(save).parent().append("<div><p>You: "+comment+"</p></div>");
                Echo.private('_reactions_').whisper('reaction_entry', {
                    id: id,
                    name: user_name,
                    type: "comment_reaction",
                    comment: comment
                })
            }
        })
        return false;
    })

    }

    presence();
    public();
    buttons();
})