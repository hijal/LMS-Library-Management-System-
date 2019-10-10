<?php
  include 'header.php';

  if (isset($_POST['issue_book'])) {
    $student_id = $_POST['student_id'];
    $book_id = $_POST['book_id'];
    $issue_date = $_POST['issue_date'];

    $result = mysqli_query($conn, "INSERT INTO `issue_book`(`student_id`, `book_id`, `book_issue_date`) VALUES ('$student_id', '$book_id', '$issue_date')");

    if ($result) {
      mysqli_query($conn, "UPDATE `books` SET `available_qty`=`available_qty` - 1 WHERE `id` = '$book_id'");
    ?>
    <script type="text/javascript">
      alert("Book issued Succesfully.");
    </script>
    <?php
    }
    else {
      ?>
      <script type="text/javascript">
        alerts("Book issued Failed.");
      </script>
      <?php
    }

  }
?>

<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
            <li><a href="javascript:avoid(0);">Issue Book</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInUp">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="panel">
      <div class="panel-content">
          <div class="row">
              <div class="col-md-12">
                  <form class="form-inline" method="post" action="">
                      <div class="form-group">
                            <select class="form-control" name="student_id">
                              <option value="">select</option>
                              <?php
                                $result = mysqli_query($conn, "SELECT * FROM `students` WHERE `status` = '1'");
                                while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                  <option value="<?= $row['id'];  ?>"><?=  ucwords($row['fname'].' '.$row['lname'].' - ('.$row['roll'].')'); ?></option>
                                  <?php
                                }
                              ?>
                            </select>
                      </div>
                      <div class="form-group">
                          <button type="submit" name="search" class="btn btn-primary">Send</button>
                      </div>
                  </form>
              </div>
          </div>
          <?php
          if (isset($_POST['search'])) {
            $id = $_POST['student_id'];
            //echo $id;
            $result = mysqli_query($conn, "SELECT * FROM `students` WHERE `id` = '$id' AND `status` = '1'");
            $row = mysqli_fetch_assoc($result);
          ?>
          <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="name">Student name</label>
                                <input type="text" class="form-control" id="name" value="<?= ucwords($row['fname'].' '.$row['lname']); ?>" readonly>
                                <input type="hidden" name="student_id" value="<?= $row['id'];  ?>">
                            </div>
                            <div class="form-group">
                                <label for="Book_Name">Book Name</label>
                                <select class="form-control" id="Book_Name" name="book_id">
                                  <option value="">select</option>
                                  <?php
                                    $result = mysqli_query($conn, "SELECT * FROM `books` WHERE `available_qty` > 0");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                      ?>
                                      <option value="<?= $row['id']  ?>"> <?= $row['book_name'];  ?></option>
                                      <?php
                                    }
                                  ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="issue_date">Book Issue Date</label>
                                <input type="text" name="issue_date" class="form-control" value="<?= date('d-m-Y') ?>" readonly>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="issue_book" class="btn btn-primary">Issue Book</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
          <?php
            //print_r($row);
            }
          ?>

      </div>

    </div>

  </div>
</div>
</div>

<?php
  include 'footer.php';
?>
