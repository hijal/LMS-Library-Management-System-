<?php
  include '../dbcon.php';

  $id = base64_decode($_GET['id']);
  //print_r($id);
  mysqli_query($conn, "UPDATE `students` SET `status` = '0' WHERE `id` = '$id'");
  header('location: students.php');
?>
