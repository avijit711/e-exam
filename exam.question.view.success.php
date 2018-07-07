
 <?php
  include 'includes/pdo.php';
  //|===========================================================================
  //| For the security perpose, User can read the pdf file at once. That means
  //| if the user get the pdf file and then refresh it he/she must enter
  //| exam ID and password again .
  //|===========================================================================
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
         <div class="col-sm-3"></div>
         <div class="col-sm-6">
           <h1><strong>Welcome!!! Question View Page!!</strong></h1>

           <div class="disabled">
             <?php
             // From privious page (exam.question.view.php) come $_SESSION['success_view']
             // as array and then viewed on embed as source
             if (isset($_SESSION['success_view'])) {
               foreach ($_SESSION['success_view'] as $X) {
                 # code...
                 echo '<embed src="'.$X.'" width="800px" height="2100px" />';

                 // echo '<a class="media" href="'.$X.'">PDF File</a> ';
               }
               unset($_SESSION['success_view']);  //This is used so that after refresh it would not visible

             } else {
               // this else block will visible when the user will refresh the page
                echo "<br><br><br><br>";
                echo '<div class="alert alert-danger"><strong>Sorry!!! You Have to Enter Exam ID and Password Again</strong></div>';
                echo "<br><br><br><br>";
                echo '<a href="exam.question.view.php" class="btn btn-info btn-block" role="button">Again Enter</a>';
             }

             ?>
           </div>


         </div>
         <div class="col-sm-3"></div>
       </div>

       <?php include 'includes/footer.inc.php' ?>
     </div>
     <script type="text/javascript" src="http://github.com/malsup/media/raw/master/jquery.media.js?v0.92"></script>
     <script type="text/javascript" src="jquery.metadata.js"></script>
   </body>
 </html>
