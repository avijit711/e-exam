<?php
  // include 'includes/pdo.php';
  if (isset($_POST['send'])) {
    if (strlen($_POST['title']) < 1 || strlen($_POST['content']) < 1) {
      $_SESSION['error'] = "All field need to be filled";
      header('Location: user.message.php');
      return;
    } else {
      //Current time
      $date = new DateTime();
      $x = $date->format('Y-m-d H:i:s');
      date_default_timezone_set("Asia/Dhaka");
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
    }
  }




?>



  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/message.css">
  </head>
  <body>
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

  </body>
