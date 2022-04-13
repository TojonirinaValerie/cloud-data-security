$(function(){
    var base_url = $(location).attr('origin');
    $(".blur-nf").hide();
    $(".panel_alert_nf").hide();

    $("#btn-nf").on("click", function(){
        $(".blur-nf").hide();
        $(".panel_alert_nf").hide();
    })
    $(".blur-nf").on("click", function(){
        $(".blur-nf").hide();
        $(".panel_alert_nf").hide();
    })

    

    $("#new_folder").on('click', function(){
        $code = "<tr id='ligne_new_folder'>"+
            "<td></td>"+
            "<td id='colonne_nom'> <img src=\""+base_url+"/cds/assets/images/ico_folder.png\" class='type-icone'> <input type='text' id='input_new_folder'/></td>"+
            "<td>Dossier</td>"+
            "<td></td>"+
            "<td>‎</td>"+
        "</tr>";
        $("#table_affichage").append($code);
        $("#input_new_folder").focus();
        $("#input_new_folder").on({
            "blur": evenement,
            "keyup": function(e){
                if(e.keyCode==13){
                    $(this.blur());
                }
            }
        });
    });

    resizeBlur();
    $(window).resize(function(){
        if(visible){
            resizeBlur();
        }
    });

    function resizeBlur(){
        if($(window).height()>$("body").height()){
            $(".blur-nf").css("height", $(window).height());
        }
        else $(".blur-nf").css("height", $("body").height()+10);
    
        if($(window).width()>$("body").width()){
            $(".blur-nf").css("width", $(window).width());
        }
        else $(".blur-nf").css("width", $("body").width());
    }

    function evenement(){
        var nom = $("#input_new_folder").val();
        if(nom.length==0){
            $("#message-nf").text("Impossible de créer le dossier car le nom est vide");
            $(".blur-nf").show();
            $(".panel_alert_nf").show();
            $("#ligne_new_folder").remove();
        }
        else{
            var nom_dossier = nom.split(" ");
            nom = nom_dossier.join("~");
            
            var adresse = base_url+"/cds/accueil/new_folder/"+nom;
            $.get(adresse, function(data){
                if(data){
                    if(data=="1" || data=="2") $("#message-nf").text("Erreur: le dossier '"+nom+"' existe déjà");
                    $(".blur-nf").show();
                    $(".panel_alert_nf").show();
                    $("#ligne_new_folder").remove();
                }
                else{
                    window.location.reload();
                }
            });

        }
    }
})