function validate()
{
	var pass1 = document.getElementById('password1');
    var pass2 = document.getElementById('password2');
    if(pass1==pass2)
    {
    	document.write("Password match.");
    	return 1;
    }
    	
    if(pass1!=pass2)
    {
    	document.write("Wrong password.");
    	return 0;
    }
    	
}

function wrongpassword()
{
	window.alert("Password doesn't match!");
}

function randomhex()
{
    var ran = ("000000"+((Math.random()*16777215+0.5)>>0).toString(16)).slice(-6);
    return ran;
}

function setusername()
{
   var ran = randomhex();
   document.getElementById("username").value= ran;
   document.getElementById("icon").value= "#" + ran;
}

function checkemail(email) {
  var xhr = new XMLHttpRequest();

// Register the embedded handler function
  xhr.onreadystatechange = function () {
  
    if (xhr.readyState == 4 && xhr.status == 200) {
        
        var result = (xhr.responseText);
        // Strip out new line chars and whitespace 
        result = result.replace(/(\r\n|\n|\r)/gm,"");
        
        if (result == "0")  {
            alert ("User is not in database");
            document.getElementById("email").innerHTML = "Enter a Valid email or sign-up";
            document.getElementById("email").focus();
            document.getElementById("email").style.backgroundColor = "red";
       } else {
            if (result = "1")  {
                document.getElementById("email").style.backgroundColor = "green";
            }  else  {
                document.getElementById("email").style.backgroundColor = "yellow";
            }
        }
    }
  }
  xhr.open("GET", "login2.php?email=" + email, true);
  xhr.send(null);


}

function iflogin(user){
    if(!user)
        document.alert("Please login!")
}



function pswcheck() {

    var userString = document.getElementById("password1").value;
    var regEx = /^[a-zA-Z0-9]{8,16}$/;

    var re = new RegExp(regEx);

    msg = re.test(userString);
    
    if(!msg)
        {
            alert("Password has to be 8-16 characters!");
        }
    if(!msg)
        return false;
    else
        return true;
};

function checklogin() {
  var xhr = new XMLHttpRequest();

// Register the embedded handler function
  xhr.onreadystatechange = function () {
  
    if (xhr.readyState == 4 && xhr.status == 200) {
        
        var result = (xhr.responseText);
        // Strip out new line chars and whitespace 
        result = result.replace(/(\r\n|\n|\r)/gm,"");
        
        if (result == "0")  {
            alert ("You have to login");
       } 
        if (result = "1")  {
            alert("Succeed");
            } 
        
    }
  }
  xhr.open("GET", "submituser.php", true);
  xhr.send(null);


}


counter = function() {
    var value = $('#posttext').val();

    if (value.length == 0) {
        $('#totalChars').html(0);
        return;
    }


    var totalChars = value.length;


    $('#totalChars').html(totalChars);

};

$(document).ready(function() {
    $('#count').click(counter);
    $('#posttext').change(counter);
    $('#posttext').keydown(counter);
    $('#posttext').keypress(counter);
    $('#posttext').keyup(counter);
    $('#posttext').blur(counter);
    $('#posttext').focus(counter);
});