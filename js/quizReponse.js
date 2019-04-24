$(document).ready(function() {
    for (var i=2;i<100;i++){
        $('#panel'+i).hide();
    }

    function functionGo(i){
        if($('#repQuestion'+i.data.int).val()!=undefined){
            if($('#repQuestion'+i.data.int).val().length<100){
                $('#panel'+(i.data.int+1)).show();
                $('#panel'+i.data.int).hide();
            }
            else{
                $('#panelError'+i.data.int).html("Merci d'insérer une réponse de moins de 100 caractères, la votre est actuellement de "+ ($('#repQuestion'+i.data.int).val().length) + " caractères");
            }
        }
        else{
            $('#panel'+(i.data.int+1)).show();
            $('#panel'+i.data.int).hide();
        }

    }

    function functionBack(i){
        $('#panel'+(i.data.int+1)).hide();
        $('#panel'+(i.data.int)).show();
        
    }

    for(var i=1;i<100;i++){
        $('#step'+(i+1)+'by'+i).click({int: i},functionGo);
        $('#step'+i+'by'+(i+1)).click({int: i},functionBack);
    }
/*
    for(var i=2;i<100;i++){
        $('step'+(i-1)+'by'+i).click({int: i},functionBack);
    }*/

});