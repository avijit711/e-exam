

<form method="post">
  <button type="submit" name="button">Show time</button>
</form>
<?php
if (isset($_POST['button'])) {
  date_default_timezone_set("Asia/Dhaka");
  $x = $timestamp = date('Y-m-d G:i:s');;
  echo $x;
}





// Asia/Dhaka
?>
