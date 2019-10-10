<?php
  include 'header.php';

  $students_data = mysqli_query($conn, "SELECT * FROM `students`");
  $total_students = mysqli_num_rows($students_data);

  $librarians_data = mysqli_query($conn, "SELECT * FROM `librarian`");
  $total_librarians = mysqli_num_rows($librarians_data);

  $books_data = mysqli_query($conn, "SELECT * FROM `books`");
  $total_books = mysqli_num_rows($books_data);
  $book_qty = mysqli_query($conn, "SELECT SUM(`book_qty`) AS total FROM `books`");
  $qty = mysqli_fetch_assoc($book_qty);
  $book_available_qty = mysqli_query($conn, "SELECT SUM(`available_qty`) AS total FROM `books`");
  $available_qty = mysqli_fetch_assoc($book_available_qty);
  //echo $qty['total'];
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
    <div class="col-md-12">
      <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="panel widgetbox wbox-1 bg-lighter-2 color-light">
                <a href="students.php">
                    <div class="panel-content">
                        <h1 class="title color-darker-2"> <i class="fa fa-users"></i> <?= $total_students; ?> </h1>
                        <h4 class="subtitle color-darker-1">Total Students</h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="panel widgetbox wbox-1 bg-darker-2 color-light">
              <a href="#">
                  <div class="panel-content">
                      <h1 class="title color-light-1"> <i class="fa fa-users"></i> <?= $total_librarians ?> </h1>
                      <h4 class="subtitle">Total Librarian</h4>
                  </div>
              </a>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="panel widgetbox wbox-1 bg-darker-1">
              <a href="manage.pphp">
                  <div class="panel-content">
                      <h1 class="title color-w"><i class="fa fa-book"></i> <?= $total_books.' ('.$qty['total'].' - '.$available_qty['total'].')' ?>  </h1>
                      <h4 class="subtitle color-lighter-1">Books</h4>
                  </div>
              </a>
          </div>
        </div>
      </div>
    </div>
</div>
</div>

<?php
  include 'footer.php';
?>
