$(function(){
    resizeBlur();
    var visible = false;
    $(".blur-sup").hide();
    $(".panel_alert_supprimer").hide();
    
    $("#delete").on("click", function(){
        //recuperer les id des elements selectionnés
        var elements = [];
        var tab = $(".case_a_cocher");
        
        for(var i=0; i<tab.length; i++){
            if($(tab[i]).prop("checked")==true){elements.push($(tab[i]).val())}
        }

        if(elements.length>0){
            var base_url = $(location).attr('origin');
            var param = elements.join("-");
            var adresse = base_url+"/cds/accueil/get_liste_file/"+param;
            $.getJSON(adresse, function(data){
                var ligne = "";
                for(var item in data){
                    ligne += data[item]+"<br>";
                }
                $("#liste_sup").html(ligne);
            });
            
            //lien de suppression pour le bouton
            $("#link_del").attr("href", base_url+"/cds/accueil/supprimer_files/"+param);

            //affichage de l'alert
            visible = true;
            $(".blur-sup").show();
            $(".panel_alert_supprimer").show(); 
            $(window).resize(function(){
                if(visible){
                    resizeBlur();
                }
            });
        }
        else{
            alert("Aucun élément n'a été séléctionné");
        }
    });


    $(".blur-sup").on("click", function(){
        $(this).hide();
        $(".panel_alert_supprimer").hide();
        visible = false;
    });
    $("#annuler").on("click", function(){
        $(".blur-sup").hide();
        $(".panel_alert_supprimer").hide();
        visible = false;
    });

    function resizeBlur(){
        if($(window).height()>$("body").height()){
            $(".blur-sup").css("height", $(window).height());
        }
        else $(".blur-sup").css("height", $("body").height()+10);
    
        if($(window).width()>$("body").width()){
            $(".blur-sup").css("width", $(window).width());
        }
        else $(".blur-sup").css("width", $("body").width());

    }
})