<?php
include 'includes/pdo.php';

//If there is active admin
if ( !isset($_SESSION['active_admin']) ) {
die ("Not logged in!");
}

//Unseen message counting
$message_sql = "SELECT COUNT(id) as num FROM message WHERE status = 0";
$message_stmt = $pdo->query($message_sql);
$message_count = $message_stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION['msgno'] = $message_count['num'];





// Adding a new notice
if (isset($_POST['notice_submit'])) {

  //Checking of empty input
  if (strlen($_POST['title'])<1 || strlen($_POST['content'])<1) {
    $_SESSION['error'] = "Title and content must need to be filled";
  }

  //Inserting data
  else {

    // $_SESSION['error'] = $_SESSION['admin_name'];
    $sql3 = "INSERT INTO notice(title, content, creator) VALUES (:title, :content , :creator)";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute(array(
      ':title' => $_POST['title'],
      ':content' => $_POST['content'],
      ':creator' => $_SESSION['admin_name']
    ));


    $_SESSION['success'] = 'Successfully Announced the notice';




  }



  header('Location: admin.dashboard.php');
  return;
}


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin panel</title>
    <?php include 'includes/link.inc.php' ?>
    <link rel="stylesheet" href="css/style.css">


  </head>
  <body>
    <div class="main_body">
      <?php include 'includes/header.inc.php' ?>
      <?php include 'includes/moving-notice.inc.php' ?>
      <?php include 'includes/navbar.inc.php' ?><div class="clr"></div>
      <h1 style="background-color: #73a508;padding: 10px;color:white;border-radius: 5px" align="center"><strong>ADMIN PANEL</strong></h1>




      <div class="row">
        <div class="col-sm-3">
          <form action="admin.dashboard.control.php" method="post">
            <input type="submit" style="margin-top: 20px" name="dashboard" class="btn btn-success btn-block " value="Dashboard">
            <input type="submit" style="margin-top: -5px" name="profile" class="btn btn-success btn-block" value="Profile">
            <button type="submit" style="margin-top:-5px"  name="message" class="btn btn-success btn-block">Message <span class="badge"><? echo $_SESSION['msgno']; ?></span></button>
            <input type="submit" style="margin-top:-5px" name="question" class="btn btn-success btn-block" value="Question" >
            <input type="submit" style="margin-top:-5px" name="centre" class="btn btn-success btn-block" value="Exam Centre">
            <input type="submit" style="margin-top:-5px" name="Notice" class="btn btn-success btn-block" value="Notice">

          </form>
          </div>
        <div class="col-sm-9">





            <h1>Welcome to Admin panel</h1>
            <h3>
            <?php
            if (isset($_SESSION['active'])) {
              # code...
              echo "Welcome to ".$_SESSION['active']." page.....";
            }
            ?></h3>
            <?php if ($_SESSION['active'] === "question"){ ?><br><br>
                <a class="btn btn-info" href="exam.question.upload.php">Upload</a>
                <a class="btn btn-info" href="#">Edit</a>
                <a class="btn btn-info" href="exam.question.view.php">View</a>
                <a class="btn btn-info" href="#">Delete</a>





            <?php } ?>



            <!--
            ||==================================================
             This is the notice view
            ||==================================================
           -->
            <?php if ($_SESSION['active'] === "notice"){ ?>

              <!-- Notice View Table -->
              <table class="table table-hover table-bordered">
                <tr>
                  <th>Notice Title</th>
                  <th>Creator</th>
                </tr>


                  <?php
                  $notice_sql = "SELECT * FROM notice";
                  $notice_stmt = $pdo->query($notice_sql);
                  $notices = $notice_stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($notices as $key => $notice) {
                      echo "<tr><td><a href='notice.view.php?id=".$notice['notice_id']."'>".$notice['title']."</a></td>";
                      echo "<td>".$notice['creator']."<td></tr>";
                    }


                  ?>




              </table>


              <!-- Error for adding new notice -->
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
              <br>
              <div class="container">
                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Add New Notice</button>
                <div id="demo" class="collapse">
                  <div class="col-sm-8">
                    <h3 class="alert alert-success">Announce Notice</h3>
                    <form class="" action="admin.dashboard.php" method="post">

                      <div class="form-group">
                        <label for="usr">Title:</label>
                        <input type="text" name="title" class="form-control" id="usr">
                      </div>

                      <div class="form-group">
                        <label for="comment">Content:</label>
                        <textarea class="form-control" name="content" rows="5" id="comment"></textarea>
                      </div>
                      <button type="submit" name="notice_submit" class="btn btn-default">Submit</button>
                    </form>

                  </div>


                </div>
              </div>


            <?php } ?>

            <?php if ($_SESSION['active'] === "profile"){
              include 'admin.profile.php';
             }
            ?>


            <?php if ($_SESSION['active'] === "message") { ?>

              <!-- Notice View Table -->
              <table class="table table-hover table-bordered">
                <tr>
                  <th>Message Title</th>
                  <th>Sender</th>
                  <th>Received</th>
                </tr>



            <!-- =========================================================
                ||
                || Message view part
                ||
                ========================================================= -->
                  <?php
                  $notice_sql = "SELECT * FROM message,userinfo WHERE message.sender_id = userinfo.user_id ORDER BY id DESC";
                  $notice_stmt = $pdo->query($notice_sql);
                  $messages = $notice_stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($messages as $key => $message) {
                      if ($message['status'] > 0) {
                        echo "<tr>";
                      } else {
                        echo "<tr class='success'>";
                      }
                      echo "<td><a href='message.view.php?id=".$message['id']."'>".$message['title']."</a></td>";
                      echo "<td>".$message['fname']."</td>";
                      echo "<td>".$message['sent_at']."</td></tr>";
                    }


                  ?>




              </table>


            <?php } ?>

            <?php if ($_SESSION['active'] === "profile"){
              include 'admin.profile.php';
             }
            ?>


            <?php if ($_SESSION['active'] === "centre") { ?>

              <!-- Notice View Table -->
              <table class="table table-hover table-bordered">
                <tr>
                  <th>Message Title</th>
                  <th>Sender</th>
                  <th>Received</th>
                </tr>



            <!-- =========================================================
                ||
                || Message view part
                ||
                ========================================================= -->
                  <?php
                  $notice_sql = "SELECT * FROM message,userinfo WHERE message.sender_id = userinfo.user_id ORDER BY id DESC";
                  $notice_stmt = $pdo->query($notice_sql);
                  $messages = $notice_stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($messages as $key => $message) {
                      if ($message['status'] > 0) {
                        echo "<tr>";
                      } else {
                        echo "<tr class='success'>";
                      }
                      echo "<td><a href='message.view.php?id=".$message['id']."'>".$message['title']."</a></td>";
                      echo "<td>".$message['fname']."</td>";
                      echo "<td>".$message['sent_at']."</td></tr>";
                    }


                  ?>




              </table>


            <?php } ?>



        </div>
        <div class="col-sm-3"></div>

    </div><br><br>
      <?php include 'includes/footer.inc.php' ?>

  </body>
</html>
