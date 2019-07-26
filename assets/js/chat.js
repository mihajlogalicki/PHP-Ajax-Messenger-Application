$(document).ready(function(){
    $(".chat-form").keypress(function(event){
        // on ENTER
        if(event.keyCode == 13){
            var textMessage = $("#text_message").val();
            if(textMessage.length != ""){
                $.ajax({
                    type: "POST",
                    url: "ajax/send_message.php",
                    data: {textMessage: textMessage},
                    dataType: "JSON",
                    success: function(response){
                        if(response.status == "success"){
                           show_messages();
                        }
                    }
                });
            }
        }
    });

    // Upload images & files
    $("#upload-files").change(function(){
        var file_name = $("#upload-files").val();
        if(file_name.length != ""){
            $.ajax({
                type: "POST",
                url: "ajax/send_files.php",
                data: new FormData($(".chat-form")[0]),
                contentType: false,
                processData: false,
                success: function(response){
                    if(response == "error"){
                        $(".files-error").addClass("show-file-error");
                        setTimeout(function(){
                            $(".files-error").removeClass("show-file-error");
                        }, 3000);
                    } else if(response == "success"){
                        show_messages();
                    }
                    // on click X hide error file message
                    $(".files-cross-icon").click(function(){
                        $(".files-error").hide();
                    })
                }
            })
        }
    });
    setInterval(function(){
        show_messages();
        online_users();
    }, 1000);
});
function online_users(){
    $.ajax({
        type: "GET",
        url: "ajax/online_users.php",
        dataType: "JSON",
        success: function(response){
           $(".online_users").html(response.users);
        }
    })
}
function show_messages(){
    $.ajax({
        type: "GET",
        url: "ajax/get_messages.php",
        success: function(response){
            $(".messages").html(response);
        }
    })
}
show_messages();