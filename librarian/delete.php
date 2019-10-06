<?php
  include '../dbcon.php';

  if (isset($_GET['bookdelete'])) {
    $id = base64_decode($_GET['bookdelete']);
    mysqli_query($conn, "DELETE FROM `books` WHERE `id` = '$id'");
    header('location: manage_book.php');
  }

?>
