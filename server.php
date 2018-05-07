<?php

//start session - server
session_start();


if(isset($_POST['sbmt']))
{
    ob_end_clean(); //clean previous displayed echoed  --End of Outer Buffer--
    
    //validate the logins
    loginvalidate($_POST['CSR'],$_COOKIE['session_id_ass2'],$_POST['user_name'],$_POST['user_pswd']);

}


//function to validate Login
function loginvalidate($user_CSRF,$user_sessionID, $username, $password)
{
    if($username=="admin" && $password=="12345" && $user_CSRF==$_COOKIE['csrf_token'] && $user_sessionID==session_id())
    {
        echo "<script> alert('Login Sucess') </script>";
        echo "Welcome Admin"."<br/>"; 
        apc_delete('CSRF_token');
    }
    else
    {
        header('Location: redirect.php');
    }
}


?>