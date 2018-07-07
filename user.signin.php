<?php
  include 'includes/pdo.php';


  if (isset($_POST['signin'])) {

    //Query Check for correct Users
    $mail = htmlentities($_POST['email']);
    $pw = htmlentities($_POST['pw']);
    $check = "SELECT user_id, email, pw FROM userinfo WHERE email = '$mail' AND pw = '$pw'";
    $stmt1 = $pdo->query($check);
    $user = $stmt1->fetch(PDO::FETCH_ASSOC);


    // $_SESSION['error'] = "Yes";
    //If already used the mail ID
    if ($user == false) {
      $_SESSION['error'] = "Email or password is not correct or Field are empty";
    } else {
      $_SESSION['success'] = "Successfully Logged in";
      $_SESSION['active_user'] = $user['user_id'];
      $_SESSION['user_status'] = 0;
      header('Location: user.dashboard.php');
      return;
    }



    header('Location: user.signin.php');
    return;
  }


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>E-examination Bangladesh</title>
    <?php include 'includes/link.inc.php' ?>

  </head>
  <body>
    <div class="main_body">
      <?php include 'includes/header.inc.php' ?>
      <?php include 'includes/moving-notice.inc.php' ?>
      <?php include 'includes/navbar.inc.php' ?><div class="clr"></div>

      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
          <h1>Login as Users</h1>
          <?php


          if (isset($_SESSION['error'])) {
            echo "<p class='alert alert-danger'>".$_SESSION['error']."</p>";
            unset($_SESSION['error']);
          }



          ?>




          <form action="user.signin.php" method="post">
            <div class="form-group">

            <div class="form-group">
              <label for="formGroupExampleInput">Email</label>
              <input type="email" name="email" class="form-control" id="formGroupExampleInput" placeholder="email@host.com">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">Password</label>
              <input type="password" name="pw" class="form-control" id="formGroupExampleInput" placeholder="Password...">
            </div>

            <div class="col-auto">
              <button type="submit" name="signin" class="btn btn-primary mb-2">Signin</button>
            </div>
          </form> <br>
          <p class="alert alert-info">Don't Have a admin ID??? Go to <strong> <a href="user.signup.php">Register</a> </strong></p>
        </div>
        <div class="col-sm-3"></div>
      </div>
    </div><br><br>
      <?php include 'includes/footer.inc.php' ?>

  </body>
</html>
