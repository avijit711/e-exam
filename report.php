<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>E-examination Bangladesh</title>
    <?php include 'includes/link.inc.php' ?>
    <link rel="stylesheet" href="css/style-report.css">


  </head>
  <body>
    <div class="main_body">
      <?php include 'includes/header.inc.php' ?>
      <?php include 'includes/moving-notice.inc.php' ?>
      <?php include 'includes/navbar.inc.php' ?>

      <div class="report-style">
        <span class="report-heading">Welcome to the report page</span><br><br>
        <form class="report-form" action="" method="post">
          <p>Report type:</p>
          <input list="browsers"  class="report-simpleInput" name="browser"  placeholder="Select here">
            <datalist id="browsers">
              <option value="Internet Explorer">
              <option value="Firefox">
              <option value="Chrome">
              <option value="Opera">
              <option value="Safari">
            </datalist><br><br>
          <p>Enter the heading of report:</p>
          <input type="text" class="report-simpleInput" name="heading" value="" placeholder="Write heading(Max 129 words)"><br><br>
          <p>Enter the body messege of report:</p>
          <textarea type="" name="body" class="report-body" value="" placeholder="Write the body of report"></textarea><br><br>
          <button type="submit" name="button">REPORT NOW</button>
        </form>
      </div>
      <?php include 'includes/footer.inc.php' ?>
    </div>
  </body>
</html>
