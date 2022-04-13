$(function(){
    resizeBlur();
    var visible = false;
    $(".blur-upload").hide();

    $("#btn_upload").on("click", function(){
        $(".blur-upload").show();
        $(".panel_alert_upload").show();
        visible = true;
    });
    
    $(window).resize(function(){
        if(visible){
            resizeBlur();
        }
    });

    $(".blur-upload").on("click", function(){
        $(this).hide();
        $(".panel_alert_upload").hide();
        visible = false;
    });
   
    $("#input_file").on("input", function(){
        $("#input_file_label").text(document.getElementById("input_file").files[0].name);
    })

    $("#upload").on("click", function(){
        var element = document.getElementById("form_upload");
        if(!document.getElementById("input_file").files[0]){
            element.addEventListener("submit", function(e){
                e.preventDefault();
            }, false);
            alert("aucun fichier selectionner");
        }
        else element.submit();
    });

    function resizeBlur(){
        if($(window).height()>$("body").height()){
            $(".blur-upload").css("height", $(window).height());
        }
        else $(".blur-upload").css("height", $("body").height()+10);
    
        if($(window).width()>$("body").width()){
            $(".blur-upload").css("width", $(window).width());
        }
        else $(".blur-upload").css("width", $("body").width());
    }
})