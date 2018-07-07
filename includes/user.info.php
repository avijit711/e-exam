<!-- User Information -->
<?php
$user_id = $_SESSION['active_user'];
$check = "SELECT * FROM userinfo WHERE user_id = '$user_id'";
$stmt1 = $pdo->query($check);
$user = $stmt1->fetch(PDO::FETCH_ASSOC);
$_SESSION['user_name'] = $user['fname']." ".$user['lname'];
echo "Logged in as <strong>".$_SESSION['user_name']." </strong>";

echo "<a  href='logout.php' class='btn btn-primary btn-sm'> Logout </a>";





// if (isset($_SESSION['success'])) {
//   echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
//   unset($_SESSION['success']);
// }
