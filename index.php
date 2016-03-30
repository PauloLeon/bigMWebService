<?php
    error_reporting(0);
 ?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login Pará Mídia</title>
    <script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/bigMWebService/elegant-login-form/css/reset.css">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="/bigMWebService/elegant-login-form/css/style.css">
  </head>
  <body>
    <form class="login" role="form" action="action_login.php" method="get">
  <fieldset>
  	<legend class="legend">Login</legend>
    <div class="input">
    	<input id="login" name="login" type="text" placeholder="Email" required />
      <span><i class="fa fa-envelope-o"></i></span>
    </div>
    <div class="input">
    	<input id="senha" name="senha" type="password" placeholder="Password" required />
      <span><i class="fa fa-lock"></i></span>
    </div>
    <button type="submit" class="submit"><i class="fa fa-long-arrow-right"></i></button>
  </fieldset>
  <div class="feedback">
  	login successful <br />
    redirecting...
  </div>
</form>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="/bigMWebService/elegant-login-form/js/index.js"></script>
  </body>
</html>
