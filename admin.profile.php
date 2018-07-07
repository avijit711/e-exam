<?php
//Admin information from admininfo table
$profile_id = $_SESSION['active_admin'];
$profile_sql = "SELECT * FROM admininfo WHERE admin_id = '$profile_id'";
$stmt101 = $pdo->query($profile_sql);
$profile = $stmt101->fetch(PDO::FETCH_ASSOC);

//Calculate the number of notice he/she announced
$count_sql = "SELECT COUNT(notice_id) as number_of_notice FROM notice WHERE creator = :admin";
$stmt102 = $pdo->prepare($count_sql);
$stmt102->execute(array(
  ':admin'=>$_SESSION['admin_name']
));
$notice_count = $stmt102->fetch(PDO::FETCH_ASSOC);

?>



<div style="background-color: #F0E5ED; border-radius: 5px; font-size: 15px; width: 800px;">
  <div style="margin: 5px; padding: 10px">
    <p><strong>Name: </strong><i><?php echo $_SESSION['admin_name']; ?></i></p>
    <p><strong>Email: </strong><i><?php echo $profile['email']; ?></i></p>
    <p><strong>Type of Admin: </strong><i><?php echo $profile['type']; ?></i></p>
    <p><strong>Number of Notice Announced: </strong><i><?php echo $notice_count['number_of_notice']; ?></i></p>
  </div>


</div>
