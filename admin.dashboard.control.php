<?php
include 'includes/pdo.php';

if (isset($_POST['dashboard'])) {
  $_SESSION['active'] = "dashboard";
  header('Location: admin.dashboard.php');
  return;
}
if (isset($_POST['profile'])) {
  $_SESSION['active'] = "profile";
  header('Location: admin.dashboard.php');
  return;
}
if (isset($_POST['message'])) {
  $_SESSION['active'] = "message";
  header('Location: admin.dashboard.php');
  return;
}
if (isset($_POST['question'])) {
  $_SESSION['active'] = "question";
  header('Location: admin.dashboard.php');
  return;
}
if (isset($_POST['centre'])) {
  $_SESSION['active'] = "exam centre";
  header('Location: admin.dashboard.php');
  return;
}
if (isset($_POST['report'])) {
  $_SESSION['active'] = "report";
  header('Location: admin.dashboard.php');
  return;
}
if (isset($_POST['Notice'])) {
  $_SESSION['active'] = "notice";
  header('Location: admin.dashboard.php');
  return;
}
