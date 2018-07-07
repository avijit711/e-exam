<?php
  include 'includes/pdo.php';
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
      $check_mail = "SELECT email FROM userinfo WHERE email = '$mail'";
      $stmt1 = $pdo->query($check_mail);
      $mail = $stmt1->fetch(PDO::FETCH_ASSOC);

      //If already used the mail ID
      if ($mail == true) {
        $_SESSION['error'] = "This mail is already used";
      }


      //If the mail id is not used
      else {
          $sql3 = "INSERT INTO userinfo(fname, lname, email, pw, center) VALUES (:fname, :lname, :email, :pw, :type)";
          $stmt3 = $pdo->prepare($sql3);
          $stmt3->execute(array(
            ':fname' => $_POST['fname'],
            ':lname' => $_POST['lname'],
            ':email' => $_POST['email'],
            ':pw' => $_POST['pw'],
            ':type' => $_POST['center'],
          ));


          $_SESSION['success'] = 'Successfully Signed up as User';
        }
      }
      header('Location: user.signup.php');
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
          <h1>Sign Up for User</h1>

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
              <label class="mr-sm-2" for="inlineFormCustomSelect">Exam Center: </label>
              <select class="custom-select custom-select-sm" name="center" id="inlineFormCustomSelect">
                <option selected>Choose...</option>

                <!-- Fetch Exam center  -->
                <?php
                $center_sql = "SELECT * FROM center";
                $center_stmt = $pdo->query($center_sql);
                $centers = $center_stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($centers as $key => $center) {
                  echo '<option value="'.$center['center_id'].'">'.$center['center_name'].'</option>';
                }

                ?>

              </select>
            </div> <br>
            <div class="col-auto">
              <button type="submit" name="signup" class="btn btn-primary mb-2">Submit</button>
            </div>
          </form> <br>
          <p class="alert alert-info">Go to <strong> <a href="user.signin.php">Sign In</a>  </strong> </p>

        </div>
        <div class="col-sm-3"></div>
      </div>

      <?php include 'includes/footer.inc.php' ?>
    </div>
  </body>
</html>
