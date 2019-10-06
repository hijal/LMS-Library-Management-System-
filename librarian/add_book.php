<?php
  include 'header.php';
  include '../dbcon.php';


  if (isset($_POST['submit'])) {
    $name = $_POST['book_name'];
    $author = $_POST['book_author'];
    $pub_name = $_POST['publication_name'];
    $pur_date = $_POST['purchase_date'];
    $price = $_POST['book_price'];
    $book_qty = $_POST['book_qty'];
    $available_qty = $_POST['available_qty'];
    $initial_image = explode('.', $_FILES['book_image']['name']);
    $image_extention = end($initial_image);
    $image = date("Ymhis.").$image_extention;
    $librarian_username = $_SESSION['librarian_username'];

    $result = mysqli_query($conn, "INSERT INTO `books`(`book_name`, `book_image`, `book_author_name`, `book_publication_name`, `book_purchase_date`, `book_price`, `book_qty`, `available_qty`, `librarian_username`) VALUES ('$name','$image','$author','$pub_name','$pur_date','$price','$book_qty', '$available_qty', '$librarian_username')");
    if ($result) {
      move_uploaded_file($_FILES['book_image']['tmp_name'], '../images/books/'.$image);
      $success = "Data Store Successfully";
    }
    else {
      $in_error = "Data Not Insert";
    }
  }
?>

<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
            <li><a href="javascript:avoid(0);">Add Books</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInUp">
    <div class="col-sm-6 col-sm-offset-3">
      <?php
        if (isset($success)) {
          ?>
            <div class="alert alert-success alert-dismissible fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong><?php echo $success; ?></strong>
            </div>
          <?php
        }
        ?>

        <?php
          if(isset($in_error)) {
          ?>
          <div class="alert alert-danger alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?php echo $in_error; ?></strong>
          </div>
          <?php
        }
       ?>
      <div class="panel">
        <div class="panel-content">
            <div class="row">
                <div class="col-sm-12">
                    <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <h5 class="mb-lg ">Add Books</h5>
                        <div class="form-group">
                            <label for="book_name" class="col-sm-4 control-label">Book Name</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="book_name" placeholder="Book Name" name="book_name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="book_image" class="col-sm-4 control-label">Book Image</label>
                            <div class="col-sm-8">
                              <input type="file" id="book_image" placeholder="Book Name" name="book_image" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="book_author" class="col-sm-4 control-label">Book Author</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="book_author" placeholder="Book Author Name" name="book_author" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Publication_name" class="col-sm-4 control-label">Publication Name</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="Publication_name" placeholder="Book Publication Name" name="publication_name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Purchase_date" class="col-sm-4 control-label">Purchase Date</label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control" id="Purchase_date" placeholder="Book Purchase Date" name="purchase_date" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="book_price" class="col-sm-4 control-label">Book Price</label required>
                            <div class="col-sm-8">
                              <input type="number" min="0" class="form-control" id="book_price" placeholder="Book Price" name="book_price" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="book_qty" class="col-sm-4 control-label">Book Quentity</label>
                            <div class="col-sm-8">
                              <input type="number" min="0" class="form-control" id="book_qty" placeholder="Book Quentity" name="book_qty" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="book_available_qty" class="col-sm-4 control-label">Available Quentity</label>
                            <div class="col-sm-8">
                              <input type="number" min="0" class="form-control" id="book_available_qty" placeholder="Book Available Quentity" name="available_qty" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save"> Save</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
  include 'footer.php';
?>
