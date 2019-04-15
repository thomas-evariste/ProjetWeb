$(document).ready(function() {
    $('#panel2').hide();
    $('#panel3').hide();
    $('#panel4').hide();
    $('#panel5').hide();
    $('#panel6').hide();
    $('#panel7').hide();
    $('#panel8').hide();
    $('#panel9').hide();
    $('#panel10').hide();
    $('#panel11').hide();
    $('#panel12').hide();
    $('#panel13').hide();
    $('#panel14').hide();
    $('#panel15').hide();
    $('#panel16').hide();
    $('#panel17').hide();
    $('#panel18').hide();
    $('#panel19').hide();
    $('#panel20').hide();
    
    $('#step1by2').click( function () { $('#panel1').show();$('#panel2').hide(); });
    
    $('#step2by1').click( function () { $('#panel2').show();$('#panel1').hide(); });
    $('#step2by3').click( function () { $('#panel2').show();$('#panel3').hide(); });
    
    $('#step3by2').click( function () { $('#panel3').show();$('#panel2').hide(); });
    $('#step3by4').click( function () { $('#panel3').show();$('#panel4').hide(); });
    
    $('#step4by3').click( function () { $('#panel4').show();$('#panel3').hide(); });
    $('#step4by5').click( function () { $('#panel4').show();$('#panel5').hide(); });
    
    $('#step5by4').click( function () { $('#panel5').show();$('#panel4').hide(); });
    $('#step5by6').click( function () { $('#panel5').show();$('#panel6').hide(); });
    
    $('#step6by5').click( function () { $('#panel6').show();$('#panel5').hide(); });
    $('#step6by7').click( function () { $('#panel6').show();$('#panel7').hide(); });
    
    $('#step7by6').click( function () { $('#panel7').show();$('#panel6').hide(); });
    $('#step7by8').click( function () { $('#panel7').show();$('#panel8').hide(); });
    
    $('#step8by7').click( function () { $('#panel8').show();$('#panel7').hide(); });
    $('#step8by9').click( function () { $('#panel8').show();$('#panel9').hide(); });
    
    $('#step9by8').click( function () { $('#panel9').show();$('#panel8').hide(); });
    
});