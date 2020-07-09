<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
  </head>
  <body>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="dist/css/login.css">

<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Login</h3>
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
                            <input type="password" name="password" class="form-control" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">
                            <a href="forget.php" class="ForgetPwd">Forget Password?</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 login-form-2">
                    <h3>Register</h3>
                    <?php
                    if(isset($_SESSION['errors'])) {
                      $length = count($_SESSION['errors']);
                      foreach($_SESSION['errors'] as $value) {
                        echo "
                        <div class='alert alert-danger'>
                        ".$value."
                        </div>
                        ";
                      }
                    }
                     ?>
                    <form action="submission/users.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control " name="name" placeholder="Your Name *" value="" />
                            <?=(isset($errors['name']))?$errors['name']:""?>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email *" value="" />
                            <?=(isset($errors['email']))?$errors['email']:""?>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Your Password *" value="" />
                            <?=(isset($errors['password']))?$errors['password']:""?>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="cpassword" placeholder="Retype password *" value="" />
                            <?=(isset($errors['cpassword']))?$errors['cpassword']:""?>
                        </div>
                        <div class="form-group">
                            <input type="phone" class="form-control" name="phone" placeholder="Your Phone *" value="" />
                            <?=(isset($errors['phone']))?$errors['phone']:""?>
                        </div>
                        <div class="form-group">
                            <textarea name="address" class="form-control" placeholder="Your Address *" rows="8" cols="80"></textarea>
                            <?=(isset($errors['address']))?$errors['address']:""?>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="register" class="btnSubmit" value="Create account" />
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
