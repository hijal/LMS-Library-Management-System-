<?php
  include 'header.php';
?>

<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInUp">
  <div class="col-sm-12">
    <div class="panel">
      <div class="panel-content">
          <form method="post" action="">
              <div class="row pt-md">
                  <div class="form-group col-sm-9 col-lg-10">
                          <span class="input-with-icon">
                      <input type="text" class="form-control" id="lefticon" name="search_item" placeholder="Search" required>
                      <i class="fa fa-search"></i>
                  </span>
                  </div>
                  <div class="form-group col-sm-3  col-lg-2 ">
                      <button type="submit" name="search" class="btn btn-primary btn-block">Search</button>
                  </div>
              </div>
          </form>
      </div>
    </div>

    <?php
    if (isset($_POST['search'])) {
      $search_result = $_POST['search_item'];
      ?>
      <div class="col-sm-12">
        <div class="panel">
          <div class="panel-content">
            <div class="row">
              <?php
              $result = mysqli_query($conn, "SELECT * FROM `books` WHERE `book_name` LIKE '%$search_result%'");
              $check_result = mysqli_num_rows($result);
              //echo "$check_result";
              if ($check_result > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
                  ?>
                  <div class="col-sm-3 col-md-2">
                    <img src="../images/books/<?= $data['book_image'] ?>" alt="book pic" style="width:100%; height:150px;">
                    <p><?= $data['book_name'] ?></p>
                    <span>Available : <?= $data['available_qty'] ?></span>
                  </div>
                  <?php
                }
              }
              else {
                ?>
                <h1 class="text-center" style="color:red;">Sorry!!!!!</h1>
                <script type="text/javascript">
                  alert("Book not found!!");
                  javascript:history.go(-1);
                </script>
                <?php

              }
              ?>

            </div>
          </div>
        </div>
      </div>
      <?php
    }
    else {
      ?>
      <div class="col-sm-12">
        <div class="panel">
          <div class="panel-content">
            <div class="row">
              <?php
              $result = mysqli_query($conn, "SELECT * FROM `books` ");
              while ($data = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-sm-3 col-md-2">
                  <img src="../images/books/<?= $data['book_image'] ?>" alt="book pic" style="width:100%; height:150px;">
                  <p><?= $data['book_name'] ?></p>
                  <span>Available : <?= $data['available_qty'] ?></span>
                </div>
                <?php
              }
              ?>

            </div>
          </div>
        </div>
      </div>
      <?php
    }
    ?>
  </div>
</div>

<?php
  include 'footer.php';
?>
