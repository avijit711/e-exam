<!-- User Information -->
<?php
$admin_id = $_SESSION['active_admin'];
$check = "SELECT * FROM admininfo WHERE admin_id = '$admin_id'";
$stmt1 = $pdo->query($check);
$user = $stmt1->fetch(PDO::FETCH_ASSOC);
$_SESSION['admin_name'] = $user['fname']." ".$user['lname'];
echo "<div class='well'>Logged in as <strong>".$user['fname']." ".$user['lname']." </strong>";

echo "<a  href='logout.php' class='btn btn-primary btn-sm'> Logout </a> </div>";

?>


<!-- Flash message to show login information -->
<?php
if (isset($_SESSION['success'])) {
  echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
  unset($_SESSION['success']);
}

?>
