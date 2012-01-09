$(document).ready(function(){
    $("#tech").facebox();
    $("#right_panel").hide();
    $("#url_input").live('click', function(){
        $("#url_input").val('');
    });
    
    $("#url_input").live('blur', function() {
        var val = $("#url_input").val();
        if( val == '' || val == ' ' ){
            $("#url_input").val("Long URL goes here!");
        }   
    });
    
    /* Ajax part */
    
    $("#button_input").live('click', function(){
        var url = $("#url_input").val();
        if(url == "Long URL goes here!"){
            $.facebox("<div style='color: red; width:480px; text-align: center;'>Please input a url!</div>");
        } else {
            $.ajax({
                url: '/shorten',
                data : 'url=' + escape(url),
                contentType: 'text/plain',
                success: function(data){
                    if($("#short_url").is(":hidden")){
                        $("#short_url").val(data);
                        $("#right_panel").show('fast');
                    } else {
                        $("#right_panel").hide('fast', function(){
                            $("#short_url").val(data);
                            $("#right_panel").show('fast');
                        });
                    }
                }
            });
        }
    });
});