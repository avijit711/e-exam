<?php
 include 'includes/pdo.php';
 if ( !isset($_SESSION['active_admin']) ) {
 die ("Not logged in!");
 }





?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Upload Question || Admin Panel</title>
    <?php include 'includes/link.inc.php' ?>

  </head>
  <body>
    <div class="main_body">
      <?php include 'includes/header.inc.php' ?>
      <?php include 'includes/moving-notice.inc.php' ?>
      <?php include 'includes/navbar.inc.php' ?><div class="clr"></div>
      <h1 style="background-color: #73a508;padding: 10px;color:white;border-radius: 5px" align="center"><strong>ADMIN PANEL</strong></h1>

      <div class="row">
        <div class="col-sm-3"><br><br>
          <?php //include 'includes/admin.nav.php'; ?>
        </div>
        <div class="col-sm-6">

          <?php
          //|=================================================================
          //| Flash message
          //|==================================================================
            if (isset($_SESSION['error_upload'])) {
              echo '<div class="alert alert-danger"><strong>'.$_SESSION['error_upload'].'</strong></div>';
              unset($_SESSION['error_upload']);
            }
          ?>
          <h1>Sign Up for Admin Users</h1>
          <form action="exam.question.upload.model.php" enctype="multipart/form-data" method="post"> <!-- field = exam_id,file,password -->
            <div class="form-group">
              <label for="formGroupExampleInput">Exam ID:</label>
              <input type="text" name="exam_id" class="form-control" id="formGroupExampleInput" placeholder="First Name...">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">File:</label>
              <input type="file" name="file" class="form-control" id="formGroupExampleInput2" placeholder="Last Name...">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput">Password:</label>
              <input type="password" name="password" class="form-control" id="formGroupExampleInput" placeholder="email@host.com">
            </div>

            <div class="col-auto">
              <button type="submit" name="upload" class="btn btn-primary mb-2">Submit</button>
            </div>
          </form>
          <a href="admin.dashboard.php">Back to Admin panel</a>
        </div>
        <div class="col-sm-3"></div>
      </div>

      <?php include 'includes/footer.inc.php' ?>
    </div>
  </body>
</html>
