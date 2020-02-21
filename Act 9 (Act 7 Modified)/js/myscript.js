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
function togglePasswordmain()
{
    var passtype = document.getElementById("txtPasswordmain");
    if (passtype.type === "password")
    {
        passtype.type = "text";
    }
    else
    {
        passtype.type = "password";
    }
}
function togglePasswordnew()
{
    var passtype = document.getElementById("txtNewPassword");
    if (passtype.type === "password")
    {
        passtype.type = "text";
    }
    else
    {
        passtype.type = "password";
    }
}
function login()
{
	if (txtUsername.value == null || txtUsername.value == "" || txtPassword.value == null || txtPassword.value == "") 
	{
		
	}
	else 
	{
		alert('Welcome ' + txtUsername.value);
	}
}
function myDeleteUpdate()
{
    $('#table_employee td:nth-child(2)').remove();
}
function forgotPassword()
{
	alert('Just Try To Remember');
}

//		             F         F
// 			False OR False AND True OR True = T