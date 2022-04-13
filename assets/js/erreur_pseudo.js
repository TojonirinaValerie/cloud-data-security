$(function(){
    function pseudoErreur(message){
        $("#message_pseudo").text(message);
        $("#erreur_pseudo").fadeIn(800, function(){
            setTimeout(function(){
                $("#erreur_pseudo").fadeOut(1000);
            }, 2000);
        });
    }
    pseudoErreur("Quelqu'un a déjà utilisé ce pseudo, utiliser un autre pseudo");
})
