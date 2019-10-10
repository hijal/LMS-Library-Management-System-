<?php
  include 'header.php';
?>

<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
            <li><a href="javascript:avoid(0);">students</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInUp">
  <div class="col-sm-12">
    <h4 class="section-subtitle"><b>All Students</b></h4>
    <div class="panel">
        <div class="panel-content">
            <div class="table-responsive">
                <table id="basic-table" class="data-table table-bordered table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Roll</th>
                        <th>Phone</th>
                        <th>Book Name</th>
                        <th>Book Issue Date</th>
                        <th>Return Book</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        $result = mysqli_query($conn, "SELECT `issue_book`.`book_issue_date`, `issue_book`.`id`, `issue_book`.`book_id`, `students`.`fname`, `students`.`lname`, `students`.`email`, `students`.`roll`,`students`.`phone`, `books`.`book_name`, `books`.`book_image` FROM `issue_book` INNER JOIN `students` ON `students`.`id` = `issue_book`.`student_id` INNER JOIN `books` ON `books`.`id` = `issue_book`.`book_id` WHERE `issue_book`.`book_return_date` IS NULL");
                        while ($row = mysqli_fetch_assoc($result)) {
                          ?>
                          <tr>
                            <td><?= ucwords($row['fname']." ".$row['lname']); ?></td>
                            <td><?= $row['email'];  ?></td>
                            <td><?= $row['roll'];  ?></td>
                            <td><?= $row['phone'];  ?></td>
                            <td><?= $row['book_name'];  ?></td>
                            <td><?= $row['book_issue_date'];  ?></td>
                            <td>
                              <a href="return_book.php?id=<?= base64_encode($row['id']);  ?>&bookid=<?= base64_encode($row['book_id']);  ?>">Return book</a>
                            </td>
                          </tr>
                          <?php
                        }
                      ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>

<?php
  if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $book_id = base64_decode($_GET['bookid']);
    $date = date('d-m-y');
    $result = mysqli_query($conn, "UPDATE `issue_book` SET `book_return_date`='$date' WHERE `id`='$id'");
    if ($result) {
      mysqli_query($conn, "UPDATE `books` SET `available_qty`=`available_qty` + 1 WHERE `id` = '$book_id'");
      ?>
      <script type="text/javascript">
        alert("Book return successfully.");
        javascript:history.go(-1);
      </script>
      <?php
    }
    else {
      ?>
      <script type="text/javascript">
        alert("Book return Failed.");
      </script>
      <?php
    }
  }

?>

<?php
  include 'footer.php';
?>
