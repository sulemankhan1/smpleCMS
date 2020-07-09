<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Reset password</title>
  </head>
  <body>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="dist/css/login.css">

<div class="container login-container">
        <div class="row">
            <div class="col-md-12 login-form-1">
                <h3>Reset Password</h3>
                <?php if(isset($_SESSION['response'])) { ?>
                    <div class="alert alert-<?=($_SESSION['response']['type'] == 'success')?'success':'danger';?>">
                        <?=$_SESSION['response']['msg']?>
                    </div>
                <?php } ?>
                <form action="submission/users.php" method="post">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Your Email *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="reset_passsword" class="btnSubmit btn-block" value="Send Reset Link" />
                    </div>
                    <div class="form-group">
                        <a href="login.php" class="ForgetPwd">Login instead</a>
                    </div>
                </form>
            </div>
        </div>
        </div>
  </body>
</html>

<?php
if(isset($_SESSION['errors'])) {
  unset($_SESSION['errors']);
}
if(isset($_SESSION['response'])) {
  unset($_SESSION['response']);
}
 ?>
