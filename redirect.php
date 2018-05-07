<?php 
    //start a session - users browser
    session_start();

    //setting a cookie
    $sessionID = session_id(); //storing session id

    //generate CSRF token
    if(empty($_SESSION['key']))
    {
        $_SESSION['key']=bin2hex(random_bytes(32));
    }

    $token = hash_hmac('sha256',$sessionID,$_SESSION['key']);
    

    setcookie("session_id_ass2",$sessionID,time()+3600,"/","localhost",false,true); //cookie terminates after 1 hour - HTTP only flag
    setcookie("csrf_token",$token,time()+3600,"/","localhost",false,true); //csrf token cookie


?>


<!DOCTYPE html>
<html>
<head>
<title>Login Failed</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="config.js"> </script>
<script> alert('Login Failed') </script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
.middlePage {
	width: 780px;
    height: 500px;
    position: absolute;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}
button {
    background-color: #00008B;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
</head>
<body>
<div class="middlePage">
<h2>Authorization Failed!! Please enter User name and Password again</h2>

<form method="POST" action="server.php">
  <div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="user_name" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="user_pswd" required>
    
    <div ><input type="hidden" id="csToken" name="CSR"/></div>
    <button name="sbmt" type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
</div>

<!-- Assign CSRF token to hidden variable -->
<script> document.getElementById("csToken").value = '<?php echo $token; ?>' </script>


</body>
</html>
