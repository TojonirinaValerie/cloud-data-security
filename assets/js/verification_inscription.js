$(function(){
    var form = document.getElementById("form-inscription");
    $("#erreur_pseudo").hide();
    $("#erreur_mdp").hide();
    $("#erreur_mail").hide();
    $("#erreur_cmdp").hide();

    $("#ipseudo").on("focus", function(){
        pseudoErreur("Le pseudo ne doit contenir que des lettres et des chiffres (Longueur max: 50)");
    })
    $("#ipseudo").on("blur", function(){
        var pseudo = $("#ipseudo").val();
        if(!pseudoIsValid(pseudo)){
            pseudoErreur("Le pseudo ne doit contenir que des lettres et des chiffres (Longueur max: 50)");
        }
    })

    $("#imdp").on("focus", function(){
        mdpErreur("min: 8 caractères");
    })
    $("#imdp").on("blur", function(){
        var mdp = $("#imdp").val();
        if(!mdpIsValid(mdp)){
            mdpErreur("Ne doit pas contenir des caractères speciaux ni d'espace (min: 8 caractères)");
        }
    })

    $("#imail").on("blur", function(){
        var mail = $("#imail").val();
        if(!mailIsValid(mail)){
            mailErreur();
        }
    })

    form.addEventListener('submit', function(e){
        var pseudo = $("#ipseudo").val();
        var mdp = $("#imdp").val();
        var confmdp = $("#imdp1").val();
        var mail = $("#imail").val();

        if(pseudoIsValid(pseudo) && mdpIsValid(mdp) && mdp==confmdp && mailIsValid(mail)){

        }
        else{
            $("#imdp").val("");
            $("#imdp1").val("");
            if(!pseudoIsValid(pseudo)){
                pseudoErreur();
            }
            else{
                if(!mdpIsValid(mdp)){
                    mdpErreur("Ne doit pas contenir des caractères speciaux ni d'espace (min: 8 caractères)");
                }
                else{
                    if(mdp!=confmdp){
                        cmdpErreur();
                    }
                    else{
                        if(!mailIsValid(pseudo)){
                            mailErreur();
                        }
                    }
                }
            }
            
            e.preventDefault();
        }
        
    }, false);

    function pseudoIsValid(pseudo){
        pseudo = pseudo.trim();
        var expression = /^[a-zA-Z0-9_]{1,50}$/;
        if(expression.test(pseudo)) {
            return true;
        }
        else return false;
    }
    
    function mdpIsValid(mdp){
        var expression = /^[a-zA-Z0-9_]{8,25}$/;
        if(expression.test(mdp)) return true;
        else return false;
    }
    
    function mailIsValid(mail){
        var expression = /^[a-z0-9_.-]+@[a-z0-9_.-]+\.[a-z]{2,6}$/;
        if(expression.test(mail)) return true;
        else return false;
    }

    function pseudoErreur(message){
        $("#message_pseudo").text(message);
        $("#erreur_pseudo").fadeIn(800, function(){
            setTimeout(function(){
                $("#erreur_pseudo").fadeOut(1000);
            }, 2000);
        });
    }
    function mdpErreur(message){
        $("#message_mdp").text(message);
        $("#erreur_mdp").fadeIn(800, function(){
            setTimeout(function(){
                $("#erreur_mdp").fadeOut(1000);
            }, 2000);
        });
    }
    function cmdpErreur(){
        $("#erreur_cmdp").fadeIn(800, function(){
            setTimeout(function(){
                $("#erreur_cmdp").fadeOut(1000);
            }, 2000);
        });
    }
    function mailErreur(){
        $("#erreur_mail").fadeIn(800, function(){
            setTimeout(function(){
                $("#erreur_mail").fadeOut(1000);
            }, 2000);
        });
    }
});