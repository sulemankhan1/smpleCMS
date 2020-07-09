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
                <h3>Please put your New password below</h3>
                <?php if(isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger">
                        <?=$_SESSION['error']?>
                    </div>
                <?php } ?>
                <form action="submission/users.php" method="post">
                <input type="hidden" name='user_id' value="<?=$_GET['id']?>">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="password" name="cpassword" class="form-control" placeholder="Confirm password *" value="" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="new_password" class="btnSubmit btn-block" value="Change password" />
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
