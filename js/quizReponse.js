$(document).ready(function() {
    $('#panel2').hide();
    
    $('#step1').click( function () { $('#panel1').show();$('#panel2').hide(); });
    
    $('#step2').click( function () { $('#panel1').hide();$('#panel2').show(); });
});