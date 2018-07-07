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
      <?php include 'includes/navbar.inc.php' ?>


      <div class="examination-plate">
        <?php
          $notice_id = $_GET['id'];

          $notice_sql = "SELECT * FROM message,userinfo WHERE message.sender_id = userinfo.user_id AND message.id = :no;UPDATE message SET status = '9' WHERE id = :no";
          $notice_stmt = $pdo->prepare($notice_sql);
          $notice_stmt->execute(array(
            ':no' => $notice_id
          ));
          $notices = $notice_stmt->fetch(PDO::FETCH_ASSOC);




        ?>
        <div class="row">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="jumbotron">
              <div class="container">
                <?php

                  echo "<h2>".$notices['title']."</h2>";


                    echo "<p class='bg-primary'> Message sent by <strong>".$notices['fname']."</strong></p>";


                  echo $notices['content'];
                ?>
              </div>

            </div>


          </div>
          <div class="col-sm-1"></div>
        </div>
      </div>
      <?php include 'includes/footer.inc.php' ?>
    </div>
  </body>
</html>
