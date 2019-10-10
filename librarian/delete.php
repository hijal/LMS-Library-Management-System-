<?php
  include '../dbcon.php';

  if (isset($_GET['bookdelete'])) {
    $id = base64_decode($_GET['bookdelete']);
    $result = mysqli_query($conn, "DELETE FROM `books` WHERE `id` = '$id'");
    if ($result) {
    ?>
    <script type="text/javascript">
      alert("Book Delete Succesfully.");
    </script>
    <?php
    }
    header('location: manage_book.php');
  }

?>
