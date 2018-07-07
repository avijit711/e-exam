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


      <div class="notice">
        <p class="noticeheader">NOTICE</p>
        <marquee id="movingnotice" direction="up" scrolldelay="200">
          <?php
          $notice_sql = "SELECT * FROM notice";
          $notice_stmt = $pdo->query($notice_sql);
          $notices = $notice_stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($notices as $key => $notice) {

              echo "<p><a tabindex='-1' href='notice.view.php?id=".$notice['notice_id']."'> ".$notice['title']." </a></p>";

            }


          ?>
         </marquee>
      </div>
      <div class="container imgslide">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="image\exampicture1.jpg" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="image\exampicture2.jpg" alt="Chicago" style="width:100%;">
      </div>

      <div class="item">
        <img src="image\exampicture3.jpg" alt="New york" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  </div><div class="clr"></div>
  <?php include 'includes/footer.inc.php' ?>
    </div>
  </body>
</html>
