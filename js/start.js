$(document).ready(function(){
    $("#tech").facebox();
    
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
        $.ajax({
            url: '/shorten',
            data : 'url=' + escape(url),
            contentType: 'text/plain',
            success: function(data){
                alert(data);
            }
        });
        
    });
});