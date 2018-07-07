<?php
include 'includes/pdo.php';

//If there is active admin
if ( !isset($_SESSION['active_user']) ) {
die ("Not logged in!");
}

if (isset($_POST['send'])) {
  if (strlen($_POST['title']) < 1 || strlen($_POST['content']) < 1) {
    $_SESSION['error'] = "All field need to be filled";

  } else {
    //Current time
    $date = new DateTime();
    $x = $date->format('Y-m-d H:i:s');

    $timestamp = date('Y-m-d G:i:s');

    //message sending
    $sql3 = "INSERT INTO message(title, content, sender_id, sent_at ) VALUES (:title, :content, :sender_id, :sent_at)";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute(array(
      ':title' => $_POST['title'],
      ':content' => $_POST['content'],
      ':sender_id' => $_SESSION['active_user'],
      ':sent_at' => $timestamp
    ));

    $_POST['message'] = 'message';
    $_SESSION['success'] = 'Successfully sent to Admin';
    header('Location: user.dashboard.php');
    return;
  }
}




?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin panel</title>
    <?php include 'includes/link.inc.php' ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/message.css">


  </head>
  <body>
    <div class="main_body">
      <?php include 'includes/header.inc.php' ?>
      <?php include 'includes/moving-notice.inc.php' ?>
      <?php include 'includes/navbar.inc.php' ?><div class="clr"></div>
      <h1 style="background-color: #73a508;padding: 10px;color:white;border-radius: 5px" align="center"><strong>USER DASHBOARD</strong></h1>
      <?php

      if (isset($_SESSION['error'])) {
        echo "<p class='alert alert-danger'>".$_SESSION['error']."</p>";
        unset($_SESSION['error']);
      }
      if (isset($_SESSION['success'])) {
        echo "<p class='alert alert-danger'>".$_SESSION['success']."</p>";
        unset($_SESSION['success']);
      }

      ?>

      <div class="container">

        <div class="row">
          <div class="col-sm-3">
            <ul class="list-group">
              <li class="list-group-item active">User Controllers</li>
              <form action="user.dashboard.php" method="post">
                <button style="text-decoration: none; font-size: 25px" type="submit" name="profile" class="list-group-item">Profile</button>
                <button style="text-decoration: none; font-size: 25px" type="submit" name="examination" class="list-group-item">Examination</button>
                <button style="text-decoration: none; font-size: 25px" type="submit" name="message" class="list-group-item">Message</button>
                <button style="text-decoration: none; font-size: 25px" type="submit" name="report" class="list-group-item">Report</button>
              </form>

            </ul>


          </div>
          <div class="col-sm-9">

            <?php
            if (isset($_POST['message'])){ ?>

              <div class="message">

                <strong><h2>Type Your Message & sent</h2></strong>


                <form method="post">

                  <div class="form-group">
                    <label for="usr">Title:</label>
                    <input type="text" name="title" class="form-control" id="usr">
                  </div>

                  <div class="form-group">
                    <label for="comment">Content:</label>
                    <textarea class="form-control" name="content" rows="5" id="comment"></textarea>
                  </div>
                  <button type="submit" name="send" class="btn btn-default">Send Message <span class="glyphicon glyphicon-envelope"></span></button>
                </form>

              </div>


            <?php } ?>
          <?php  if (isset($_POST['examination'])){
              include 'user.examination.php';
            }
            if (isset($_POST['profile'])){
              include 'user.profile.php';
            }
            if (isset($_POST['report'])){
              include 'user.report.php';
            }




            ?>





          </div>
        </div>

        <!-- <form method="post">
          <div class="btn-group">
            <button type="submit" name="button" class="btn btn-primary">Profile</button>
            <button type="submit" name="button" class="btn btn-primary">Examination</button>
            <button type="submit" name="button" class="btn btn-primary">Message</button>
            <button type="submit" name="button" class="btn btn-primary">Report</button>
          </div>
        </form> -->

      </div>



      <br><br>
      <?php include 'includes/footer.inc.php' ?>

  </body>
</html>
