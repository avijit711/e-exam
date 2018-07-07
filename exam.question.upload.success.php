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
    <title>E-examination Bangladesh</title>
    <?php include 'includes/link.inc.php' ?>

  </head>
  <body>
    <div class="main_body">
      <?php include 'includes/header.inc.php' ?>
      <?php include 'includes/moving-notice.inc.php' ?>
      <?php include 'includes/navbar.inc.php' ?><div class="clr"></div>

      <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-3">
          <img style="margin-top:-200px;margin-left:-250px" src="image/success.png" alt="">
          <div style="margin-top:-200px" class="alert alert-success">Successfully Uploaded The Question</div>
          <!-- <button  type="button" class="btn btn-primary btn-block">Done</button> -->
          <a href="admin.dashboard.php" class="btn btn-primary btn-block">Done</a>
          <br><br>
        </div>
        <div class="col-sm-5"></div>
      </div>

      <?php include 'includes/footer.inc.php' ?>
    </div>
  </body>
</html>
