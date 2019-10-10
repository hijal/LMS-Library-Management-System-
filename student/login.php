
<?php
  include '../dbcon.php';
  session_start();
  if (isset($_SESSION['student_login'])) {
   header('location: index.php');
 }

  if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM `students` WHERE `email` = '$email' OR `username` = '$email'");

    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);
      //print_r($row);
      if (password_verify($password, $row['password'])) {
        if ($row['status'] == 1) {
          header('location: index.php');
          $_SESSION['student_login'] = $email;
          $_SESSION['student_id'] = $row['id'];
        }
        else {
          $status_err = "Please Contact with Liibrarian. Your Account isn't Active";
        }
      }
      else {
        $password_err = "Invalid Password";
      }
    }
    else {
      $error = "Invalid Email or Password";
    }


    //print_r($row);
  }

?>

<!doctype html>
<html lang="en" class="fixed accounts sign-in">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Student Login</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css">
    <link rel="stylesheet" href="../assets/stylesheets/css/style.css">
</head>

<body>
<div class="wrap">
    <div class="page-body animated slideInDown">

        <div class="logo">
            <h2 class="text-center">Library Management System</h2>
            <?php
              if (isset($error)) {
                ?>
                  <div class="alert alert-warning alert-dismissible fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><?php echo $error; ?></strong>
                  </div>
                <?php
              }
              ?>

              <?php
                if (isset($password_err)) {
                  ?>
                    <div class="alert alert-danger alert-dismissible fade in">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong><?php echo $password_err; ?></strong>
                    </div>
                  <?php
                }
                ?>

                <?php
                  if (isset($status_err)) {
                    ?>
                      <div class="alert alert-danger alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong><?php echo $status_err; ?></strong>
                      </div>
                    <?php
                  }
                  ?>
        </div>
        <div class="box">
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">
                    <form action="" method="post">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="email" placeholder="Email or Username" value="<?= isset($email) ? $email : ''; ?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="remember-me" value="option1" checked>
                                <label class="check" for="remember-me">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">
                        </div>
                        <div class="form-group text-center">
                            <a href="pages_forgot-password.html">Forgot password?</a>
                            <hr/>
                             <span>Don't have an account?</span>
                            <a href="register.php" class="btn btn-block mt-sm">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../assets/vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/vendor/nano-scroller/nano-scroller.js"></script>

<script src="../assets/javascripts/template-script.min.js"></script>
<script src="../assets/javascripts/template-init.min.js"></script>
</body>
</html>
