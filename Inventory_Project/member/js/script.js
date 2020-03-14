function preventNumberInput(e){
    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (keyCode > 47 && keyCode < 58){
        e.preventDefault();
    }
}

$(document).ready(function(){
    $('#text_field').keypress(function(e) {
        preventNumberInput(e);
    });
});