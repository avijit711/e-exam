<form action="admin.dashboard.control.php" method="post">
  <input type="submit" style="margin-top: 20px" type="button" name="dashboard" class="btn btn-success btn-block <?php if (($_SESSION['action'] === "dashboard")){ ?>active<?php } ?>" value="Dashboard">
  <input type="submit" style="margin-top: -5px" type="button" name="profile" class="btn btn-success btn-block <?php if (($_SESSION['action'] === "profile")){ ?> active <?php } ?>" value="Profile">
  <input type="submit" style="margin-top:-5px" type="button"  name="message" class="btn btn-success btn-block <?php if (($_SESSION['action'] === "message")){ ?> active <?php } ?>" value="Message">
  <input type="submit" style="margin-top:-5px" type="button" name="question" class="btn btn-success btn-block <?php if (($_SESSION['action'] === "question")){ ?> active <?php } ?>" value="Question" >
  <input type="submit" style="margin-top:-5px" type="button" name="centre" class="btn btn-success btn-block <?php if (($_SESSION['action'] === "centre")){ ?> active <?php } ?>" value="Exam Centre">
  <input type="submit" style="margin-top:-5px" type="button" name="report" class="btn btn-success btn-block <?php if (($_SESSION['action'] === "report")){ ?> active <?php } ?>" value="Report Received" >
  <input type="submit" style="margin-top:-5px" type="button" name="statistics" class="btn btn-success btn-block <?php if (($_SESSION['action'] === "statics")){ ?> active <?php } ?>" value="Statistics">

</form>
