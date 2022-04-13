$(function(){
    //$("#connection").hide();
    //$("#inscription").hide();
    $(".block-page-left").css("margin-top", "80px");
    $("#se_connecter").on("click", function(){
        $("#connection").show();
        $("#inscription").hide();
        $("#image-accueil").hide();
        $(".block-page-left").css("margin-top", "40px");
    });
    $("#sinscrire").on("click", function(){
        $("#connection").hide();
        $("#inscription").show();
        $("#image-accueil").hide();
    });
    $("#accueil").on("click", function(){
        $("#connection").hide();
        $("#inscription").hide();
        $("#image-accueil").show();
    });
})