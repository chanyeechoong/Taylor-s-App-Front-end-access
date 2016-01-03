<!-- REMEMBER TO ADD REDIRECT FUNCTION TO HTTPS-->
<?php

//require_once ('util/secure_connection_helper.php');


?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">


    <title>Login</title>
        <link rel="stylesheet" href="css/style.css">
  </head>

  <body>

    <div class="container">

  <div id="login-form">

    <h3>Login</h3>

    <fieldset>

      <form action="." method="post">
        <input type="hidden" name="action" value="login">
        <input type="email" name="email" required value="Email" onBlur="if(this.value=='')this.value='Email'" onFocus="if(this.value=='Email')this.value='' "> <!-- JS because of IE support; better: placeholder="Email" -->

        <input type="password" name="password" required value="Password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' "> <!-- JS because of IE support; better: placeholder="Password" -->

        <input type="submit" value="Login">

        <footer class="clearfix">

          <li><span class="info">?</span><a href="#">Forgot Password</a></li>

        </footer>

      </form>

    </fieldset>

  </div> <!-- end login-form -->
  
  <?php if(isset($error_message)) : ?>
        <?php echo $error_message; ?>
  <?php endif; ?>

</div>

    
    
  </body>
</html>
