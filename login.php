<?php
session_start();
require('app/dbconfig.php');
require_once("app/class.user.php");
require_once('technical_stuffs/footer.php');
require_once('StripeOAuth2Client.class.php');
require_once('StripeOAuth.class.php');
require_once('OAuth2Client.php');


$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('about.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{

		$login->redirect('about.php');
	}
	else
	{
		$error = "Wrong Details !";
	}	
}

if(isset($_POST['btn-login1']))
{
header("Location: sign-up.php");
}


//   $token_request_body = array(
//     'grant_type' => 'authorization_code',
//     'client_id' => 'ca_8WINPffmxvXdEVZi55UtLkfsUQ7SXpbT',
//     'code' => $code,
//     'client_secret' => 'sk_live_uJiSZBdwb5hN8Ft18mRX2coz'
//   );

//   $req = curl_init(TOKEN_URI);
//   curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
//   curl_setopt($req, CURLOPT_POST, true );
//   curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($token_request_body));

//   // TODO: Additional error handling
//   $respCode = curl_getinfo($req, CURLINFO_HTTP_CODE);
//   $resp = json_decode(curl_exec($req), true);
//   curl_close($req);

//   echo $resp['access_token'];
// } else if (isset($_GET['error'])) { // Error
//   echo $_GET['error_description'];
// } else { // Show OAuth link
//   $authorize_request_body = array(
//     'response_type' => 'code',
//     'scope' => 'read_write',
//     'client_id' => 'ca_32D88BD1qLklliziD7gYQvctJIhWBSQ7'
//   );

//   $url = AUTHORIZE_URI . '?' . http_build_query($authorize_request_body);
//   echo "<a href='$url'>Connect with Stripe</a>";
  
//   {
//   "token_type": "bearer",
//   "stripe_publishable_key": PUBLISHABLE_KEY,
//   "scope": "read_write",
//   "livemode": false,
//   "stripe_user_id": USER_ID,
//   "refresh_token": REFRESH_TOKEN,
//   "access_token": ACCESS_TOKEN
// }




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Love Story Project Dashboard</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css"  />
</head>


<body>
    

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Log In</h2><hr />
        
        <div id="error">
        <?php
			if(isset($error))
			{
			  
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="txt_uname_email" placeholder="Username or E mail ID" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="txt_password" placeholder="Your Password" />
        </div>
       
     	<hr />
        
        <div class="form-group" align="center">
            <button type="submit" name="btn-login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; SIGN IN
            </button>
            <button type="submit1" name="btn-login1" class="btn btn-default1">
                
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; SIGN UP
            </button>
        </div>  
      	<br />
            <!--<label>Don't have account yet ! <a href="sign-up.php">Sign Up</a></label>-->
      </form>

    </div>
    
</div>
    
</body>