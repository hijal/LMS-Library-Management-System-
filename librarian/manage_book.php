<?php
  include 'header.php';
?>

<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
            <li><a href="javascript:avoid(0);">Manage Books</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInUp">
  <div class="col-sm-12">
    <h4 class="section-subtitle"><b>Books</b></h4>
    <div class="panel">
        <div class="panel-content">
            <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                      <th>Book Name</th>
                      <th>Book Image</th>
                      <th>Book Author</th>
                      <th>Publication Name</th>
                      <th>Purchase Date</th>
                      <th>Book Price</th>
                      <th>Book Quentity</th>
                      <th>Available</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        $result = mysqli_query($conn, "SELECT * FROM `books`");
                        while ($row = mysqli_fetch_assoc($result)) {
                          ?>
                          <tr>
                            <td><?= $row['book_name']; ?></td>
                            <td>
                              <img src="../images/books/<?= $row['book_image']; ?>" alt="book picture" width="50px">
                            </td>
                            <td><?= $row['book_author_name']; ?></td>
                            <td><?= $row['book_publication_name']; ?></td>
                            <td><?= date('d-M-Y', strtotime($row['book_purchase_date'])); ?></td>
                            <td><?= $row['book_price']; ?></td>
                            <td><?= $row['book_qty']; ?></td>
                            <td><?= $row['available_qty']; ?></td>
                            <td>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#book-<?= $row['id']; ?>"><i class="fa fa-eye"></i></a>
                              <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#book-update-<?= $row['id']; ?>"><i class="fa fa-pencil-square"></i></a>
                              <a href="delete.php?bookdelete=<?= base64_encode($row['id']); ?>  ?>" class="btn btn-danger" onclick="return confirm('Are You Sure You want to Delete?')"><i class="fa fa-trash-o"></i></a>
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
  $result = mysqli_query($conn, "SELECT * FROM `books`");
  while ($row = mysqli_fetch_assoc($result)) {
    ?>
<div class="modal fade" id="book-<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header state modal-info">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Book Information</h4>
          </div>
          <div class="modal-body">
            <table class="data-table table table-striped nowrap table-hover table-bordered">
              <tr>
                <th>Book Name</th>
                <td><?= $row['book_name']; ?></td>
              </tr>
              <tr>
                <th>Book Image</th>
                <td>
                  <img src="../images/books/<?= $row['book_image']; ?>" alt="book picture" width="70px" height="70px">
                </td>
              </tr>
              <tr>
                <th>Book Author</th>
                <td><?= $row['book_author_name']; ?></td>
              </tr>
              <tr>
                <th>Publication Name</th>
                <td><?= $row['book_publication_name']; ?></td>
              </tr>
              <tr>
                <th>Purchase Data</th>
                <td><?= date('d-M-Y', strtotime($row['book_purchase_date'])); ?></td>
              </tr>
              <tr>
                <th>Book Price</th>
                <td><?= $row['book_price']; ?></td>
              </tr>
              <tr>
                <th>Book Quentity</th>
                <td><?= $row['book_qty']; ?></td>
              </tr>
              <tr>
                <th>Available</th>
                <td><?= $row['available_qty']; ?></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
<?php
}
?>

<?php
  $result = mysqli_query($conn, "SELECT * FROM `books`");
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $book_info = mysqli_query($conn, "SELECT * FROM `books` WHERE `id` = '$id'");
    $book_info_row = mysqli_fetch_assoc($book_info);
    ?>
<div class="modal fade" id="book-update-<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header state modal-info">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title text-center" id="modal-info-label"><i class="fa fa-book"></i>Update Book Information</h4>
          </div>
          <div class="modal-body">
            <div class="panel">
                      <div class="panel-content">
                          <div class="row">
                              <div class="col-md-12">
                                  <form method="post" action="" class="form-horizontal">
                                    <div class="form-group">
                                        <label for="book_name" class="col-sm-4 control-label">Book Name</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" id="book_name" placeholder="Book Name" name="book_name" value="<?= $book_info_row['book_name'];  ?>">
                                          <input type="hidden" class="form-control" name="id" value="<?= $book_info_row['id'];  ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="book_author" class="col-sm-4 control-label">Book Author</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" id="book_author" placeholder="Book Author Name" name="book_author" value="<?= $book_info_row['book_author_name'];  ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Publication_name" class="col-sm-4 control-label">Publication Name</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" id="Publication_name" placeholder="Book Publication Name" name="publication_name" value="<?= $book_info_row['book_publication_name'];  ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Purchase_date" class="col-sm-4 control-label">Purchase Date</label>
                                        <div class="col-sm-8">
                                          <input type="date" class="form-control" id="Purchase_date" placeholder="Book Purchase Date" name="purchase_date" value="<?= $book_info_row['book_purchase_date'];  ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="book_price" class="col-sm-4 control-label">Book Price</label required>
                                        <div class="col-sm-8">
                                          <input type="number" min="0" class="form-control" id="book_price" placeholder="Book Price" name="book_price" value="<?= $book_info_row['book_price'];  ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="book_qty" class="col-sm-4 control-label">Book Quentity</label>
                                        <div class="col-sm-8">
                                          <input type="number" min="0" class="form-control" id="book_qty" placeholder="Book Quentity" name="book_qty" value="<?= $book_info_row['book_qty'];  ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="book_available_qty" class="col-sm-4 control-label">Available Quentity</label>
                                        <div class="col-sm-8">
                                          <input type="number" min="0" class="form-control" id="book_available_qty" placeholder="Book Available Quentity" name="available_qty" value="<?= $book_info_row['available_qty'];  ?>">
                                        </div>
                                    </div>
                                      <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <button type="submit" class="btn btn-primary" name="update"><i class="fa fa-save">Save</i></button>
                                        </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
          </div>
      </div>
  </div>
</div>
<?php
}

if (isset($_POST['update'])) {

  $name = $_POST['book_name'];
  $id = $_POST['id'];
  $author = $_POST['book_author'];
  $pub_name = $_POST['publication_name'];
  $pur_date = $_POST['purchase_date'];
  $price = $_POST['book_price'];
  $book_qty = $_POST['book_qty'];
  $available_qty = $_POST['available_qty'];
  $librarian_username = $_SESSION['librarian_username'];

  $result = mysqli_query($conn, "UPDATE `books` SET `book_name`='$name',`book_author_name`='$author',`book_publication_name`='$pub_name',`book_purchase_date`='$pur_date',`book_price`='$price',`book_qty`='$book_qty',`available_qty`='$available_qty',`librarian_username`='$librarian_username' WHERE `id`='$id'");
  if ($result) {
    //ob_start();
    if ($result) {
    ?>
    <script type="text/javascript">
      alert("Book Update Succesfully.");
      javascript:history.go(-1);
    </script>
    <?php
    }
    else {
      ?>
      <script type="text/javascript">
        alerts("Book Update Failed.");
      </script>
      <?php
    }

  }
}
?>
<?php
  include 'footer.php';
?>
