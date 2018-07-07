<?php
  include 'includes/pdo.php';
  include 'admin.config.format.php';
  // |--------------------------------------------------------
  // |  Sign up functionality( Insert data into database)
  // |--------------------------------------------------------
  if (isset($_POST['signup'])) {

    //Check if each field is given
    if (strlen($_POST['fname'])<1 || strlen($_POST['lname'])<1 || strlen($_POST['email'])<1 || strlen($_POST['pw'])<1) {
      $_SESSION['error'] = "All field must be filled";
    }
    else {

      //Assurance for unique email id

      $mail = htmlentities($_POST['email']);
      $check_mail = "SELECT email FROM admininfo WHERE email = '$mail'";
      $stmt1 = $pdo->query($check_mail);
      $mail = $stmt1->fetch(PDO::FETCH_ASSOC);

      //If already used the mail ID
      if ($mail == true) {
        $_SESSION['error'] = "This mail is already used";
      }


      //If the mail id is not used
      else {

        //Number of Admin check-----($number_of_admin variable comes from admin.config.format.php file)

        $check_mail = "SELECT count(admin_id) AS num FROM admininfo";
        $stmt2 = $pdo->query($check_mail);
        $num = $stmt2->fetch(PDO::FETCH_ASSOC);

        $number_of_admin = $num['num'];

        if ($number_of_admin >= $number_of_admin_need_to_be) {
          $_SESSION['error'] = "Sorry Sir!!! Number of Admin is already Filled. ";
        } else {
          $sql3 = "INSERT INTO admininfo(fname, lname, email, pw, type) VALUES (:fname, :lname, :email, :pw, :type)";
          $stmt3 = $pdo->prepare($sql3);
          $stmt3->execute(array(
            ':fname' => $_POST['fname'],
            ':lname' => $_POST['lname'],
            ':email' => $_POST['email'],
            ':pw' => $_POST['pw'],
            ':type' => $_POST['type'],
          ));


          $_SESSION['success'] = 'Successfully Signed up as Admin';
        }
      }

    }



  header('Location: admin.signup.php');
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
          <h1>Sign Up for Admin Users</h1>

          <!-- Error/Success message Show for sign up -->
          <?php
            if (isset($_SESSION['error'])) {
              echo "<p class='alert alert-danger'>".$_SESSION['error']."</p>";
              unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
              echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
              unset($_SESSION['success']);
            }

          ?>

          <form method="post">
            <div class="form-group">
              <label for="formGroupExampleInput">First Name</label>
              <input type="text" name="fname" class="form-control" id="formGroupExampleInput" placeholder="First Name...">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">lname</label>
              <input type="text" name="lname" class="form-control" id="formGroupExampleInput2" placeholder="Last Name...">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">Email</label>
              <input type="email" name="email" class="form-control" id="formGroupExampleInput" placeholder="email@host.com">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">Password</label>
              <input type="password" name="pw" class="form-control" id="formGroupExampleInput" placeholder="Password...">
            </div>
            <div class="col-auto my-1">
              <label class="mr-sm-2" for="inlineFormCustomSelect">Type: </label>
              <select class="custom-select custom-select-sm" name="type" id="inlineFormCustomSelect">
                <option selected>Choose...</option>
                <option value="Monitoring Admin">Monitoring Admin</option>
                <option value="Call Center">Call Center</option>
                <option value="Data Admin">Data admin</option>
              </select>
            </div> <br>
            <div class="col-auto">
              <button type="submit" name="signup" class="btn btn-primary mb-2">Submit</button>
            </div>
          </form> <br>
          <p class="alert alert-info">Go to <strong> <a href="admin.signin.php">Sign In</a>  </strong> </p>

        </div>
        <div class="col-sm-3"></div>
      </div>

      <?php include 'includes/footer.inc.php' ?>
    </div>
  </body>
</html>
