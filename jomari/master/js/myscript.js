/**
 * Created by Jomari Garcia on 1/25/2020.
 */
// Disable form submissions if there are invalid fields
(function()
{
    'use strict';
    window.addEventListener('load', function()
    {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form)
        {
            form.addEventListener('submit', function(event)
            {
                if (form.checkValidity() === false)
                {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
function code_generaton()
{
    charSet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    var randomString = '';
    for (var i = 0; i < 20; i++) {
        var randomPos = Math.floor(Math.random() * charSet.length);
        randomString += charSet.substring(randomPos, randomPos + 1);
    }
    document.getElementById("txtActivation_Code_"+e).value = randomString;
    return randomString;
}
function Copy()
{
    var copyText = document.getElementById("txtActivation_Code_");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
}
function togglePassword()
{
    var passtype = document.getElementById("txtPassword");
    if (passtype.type === "password")
    {
        passtype.type = "text";
    }
    else
    {
        passtype.type = "password";
    }
}
function togglePassword()
{
    var passtype = document.getElementById("txtPassword");
    if (passtype.type === "password")
    {
        passtype.type = "text";
    }
    else
    {
        passtype.type = "password";
    }
}
function textarea_code()
{
    var t_area = document.getElementById('').value+="";
}

function download()
{
    var text = document.getElementById("txtActivation_Code_").value;
    text = text.replace(/\n/g, "\r\n"); // To retain the Line breaks.
    var blob = new Blob([text], { type: "text/plain"});
    var anchor = document.createElement("a");
    anchor.download = "Activation_codes.csv";
    anchor.href = window.URL.createObjectURL(blob);
    anchor.target ="_blank";
    anchor.style.display = "none"; // just to be safe!
    document.body.appendChild(anchor);
    anchor.click();
    document.body.removeChild(anchor);
}