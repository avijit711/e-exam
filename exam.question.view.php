<?php

// |------------------------------------------------------
// | This is the question view page
// |------------------------------------------------------
  include 'includes/pdo.php';
  if (isset($_POST['view'])) {

    //Check whether any field is empty
    if (strlen($_POST['exam_id']) < 1 || strlen($_POST['password']) <1) {
      $_SESSION['error_view'] = "No field should be empty";
      header('Location: exam.question.view.php'); // Redirect the page for error
      return;
    } else {

      //Query the database to fetch the pdf file
      $stmt = $pdo->prepare('SELECT file FROM pdf WHERE exam_id = :exam_id AND password = :password');
      $stmt->execute(array(
        ':exam_id'=>$_POST['exam_id'],
        ':password'=>$_POST['password']
      ));
      $row = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the pdf file as $row

      //If the $row is empty,we asseme that the password or exam_id is wrong
      if ($row === false) { //If $row is empty
        $_SESSION['error_view'] = "Incorrect Exam ID or password";
        header('Location: exam.question.view.php'); // Redirect the page for error
        return;
      } else { // Exam_id and password is Correct
        $_SESSION['success_view'] = $row;
        header('Location: exam.question.view.success.php');
        return;

        // $_SESSION['view_success'] = "Welcome!! Successfully Entered the EXAM ID and Password";
        // header('Location: exam.question.view.success.php');
        // return;
      }

    }
  }


?>
<!-- This is the model part -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>View Question</title>
    <?php include 'includes/link.inc.php' ?>

  </head>
  <body>
    <div class="main_body">
      <?php include 'includes/header.inc.php' ?>
      <?php include 'includes/moving-notice.inc.php' ?>
      <?php include 'includes/navbar.inc.php' ?><div class="clr"></div>
      <h1 style="background-color: #73a508;padding: 10px;color:white;border-radius: 5px" align="center"><strong>ADMIN PANEL</strong></h1>

      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
          <?php
          // |------------------------------------------------------
          // | View flash message for error message
          // |------------------------------------------------------
            if (isset($_SESSION['error_view'])) {
              echo '<div class="alert alert-danger"><strong>'.$_SESSION['error_view'].'</strong></div>';
              unset($_SESSION['error_view']);
            }
          ?>
          <h1>Question View page !</h1>
          <form action="exam.question.view.php" enctype="multipart/form-data" method="post"> <!-- field = exam_id,file,password -->
            <div class="form-group">
              <label for="formGroupExampleInput">Exam ID:</label>
              <input type="text" name="exam_id" class="form-control" id="formGroupExampleInput" placeholder="First Name...">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">Password:</label>
              <input type="password" name="password" class="form-control" id="formGroupExampleInput" placeholder="email@host.com">
            </div>

            <div class="col-auto">
              <button type="submit" name="view" class="btn btn-primary mb-2">View</button>
            </div>
          </form>
          <a href="admin.dashboard.php">Back to Admin panel</a><br>
        </div>
        <div class="col-sm-3">
          <?php

          ?>
        </div>
      </div>

      <?php include 'includes/footer.inc.php' ?>
    </div>
  </body>
</html>
