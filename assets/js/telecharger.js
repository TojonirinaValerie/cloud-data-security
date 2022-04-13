$(function(){
    $("#download").on("click", function(){
        var elements = [];
        var tab = $(".case_a_cocher");
        for(var i=0; i<tab.length; i++){
            if($(tab[i]).prop("checked")==true){elements.push($(tab[i]).val())}
        }
        var base_url = $(location).attr('origin');
        var param = elements.join("-");
        $("#download_link").attr("href", base_url+"/cds/assets/uploads/4/tojo.rar");
    });
});