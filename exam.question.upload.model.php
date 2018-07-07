<?php
  include 'includes/pdo.php'; //connect database

  //Auth check
  if ( !isset($_SESSION['active_admin']) ) {
  die ("Not logged in!");
  }



  if (isset($_POST['upload'])) { // whether click to upload
    // form validation check
    $file = "upload/".$_FILES['file']['name'];
    $type = pathinfo($file,PATHINFO_EXTENSION);
    if (strlen($_POST['exam_id']) < 1 || strlen($file) < 1 || strlen($_POST['password']) < 1) {
      $_SESSION['error_upload'] = "All field need to be written";
      header('Location: exam.question.upload.php');
      return;
    } else { //ALL FIELD IS FULFILLED
        if ($_FILES['file']['size'] > 20000000) {
          $_SESSION['error_upload'] = "File must be in 20MB";
          header('Location: exam.question.upload.php');
          return;
        } elseif ($type != "pdf") {
          $_SESSION['error_upload'] = "PDF file is only allowed";
          header('Location: exam.question.upload.php');
          return;
        }else {
          move_uploaded_file($_FILES['file']['tmp_name'],$file);


          // copy($_FILES['file']['tmp_name'], $file);

          $stmt = $pdo->prepare("INSERT INTO pdf (exam_id, file, password) VALUES (:exam_id, :file, :password)");
          $stmt->execute(array(
            ':exam_id'=>$_POST['exam_id'],
            ':file'=>$file,
            ':password'=>$_POST['password']
          ));
          $_SESSION['success']="Successfully Uploaded The Question";
          header('Location: exam.question.upload.success.php');
          return;
        }
    }
  }
