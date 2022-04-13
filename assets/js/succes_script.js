$(function(){
    resizeBlur();
    $(window).resize(function(){
        if(visible){
            resizeBlur();
        }
    });

    function resizeBlur(){
        if($(window).height()>$("body").height()){
            $(".blur-succes").css("height", $(window).height());
        }
        else $(".blur-succes").css("height", $("body").height()+10);
    
        if($(window).width()>$("body").width()){
            $(".blur-succes").css("width", $(window).width());
        }
        else $(".blur-succes").css("width", $("body").width());
    }
})