


<nav class="navbar navcolor">
  <div class="container-fluid">

    <ul class="nav navbar-nav">
      <li><a href="index.php">HOME</a></li>
      <li><a href="#">ABOUT</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">EXAMINATION<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="jsc.php">JSC</a></li>
          <li><a href="ssc.php">SSC</a></li>
          <li><a href="hsc.php">HSC</a></li>
        </ul>
      </li>
      <?php if (!isset($_SESSION['active_admin'])) {?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">ADMIN<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="admin.signup.php">SIGN UP</a></li>
          <li><a href="admin.signin.php">SIGN IN</a></li>
        </ul>
      </li>
    <?php } ?>

      <?php if (!isset($_SESSION['active_admin'])) {?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">HALL<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="user.signup.php">SIGN UP</a></li>
          <li><a href="user.signin.php">SIGN IN</a></li>
        </ul>
      </li>



      <li><a href="report.php">REPORT</a></li>
      <li><a href="#">CONTACT US</a></li><?php } ?>


      <?php if (isset($_SESSION['active_admin'])) { ?>
        <li><a href="admin.dashboard.php">DASHBOARD</a></li>
      <?php } ?>
    </ul>
  </div>
</nav>
<?php
if (isset($_SESSION['active_admin'])){
  include 'includes/admin.user.php';
 }

 
 ?>
