<?php
include 'includes/pdo.php';
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

          $notice_sql = "SELECT * FROM notice WHERE notice_id = :no";
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
                  if (isset($_SESSION['active_admin'])) {

                    echo "<p class='bg-primary'> This noice was announced by <strong>".$notices['creator']."</strong></p>";

                  }
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
