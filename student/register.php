<?php
    include "../dbcon.php";
    session_start();
    if (isset($_SESSION['student_login'])) {
     header('location: index.php');
   }


    if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $roll = $_POST['roll'];
        $req = $_POST['req'];
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $con_password = $_POST['confirm-password'];

        $input_errors = array();

        if (empty($fname)) {
          $input_errors['fname'] = "First Name Field is required.";
        }

        if (empty($lname)) {
          $input_errors['lname'] = "Last Name Field is required.";
        }

        if (empty($email)) {
          $input_errors['email'] = "E-mail Field is required.";
        }

        if (empty($username)) {
          $input_errors['username'] = "Username Field is required.";
        }
        if (empty($roll)) {
          $input_errors['roll'] = "Roll Field is required.";
        }
        if (empty($req)) {
          $input_errors['req'] = "Registration Field is required.";
        }
        if (empty($phone)) {
          $input_errors['phone'] = "Phone Field is required.";
        }
        if (empty($password)) {
          $input_errors['password'] = "Password Field is required.";
        }

        $errors = count($input_errors);
        if ($errors == 0) {

          $email_check = mysqli_query($conn, "SELECT * FROM `students` WHERE `email` = '$email'");
          $is_exists = mysqli_num_rows($email_check);
          if ($is_exists == 0) {
            $username_check = mysqli_query($conn, "SELECT * FROM `students` WHERE `username` = '$username'");
            $is_username_exists = mysqli_num_rows($username_check);
            if ($is_username_exists == 0) {
              if (strlen($username) > 7) {
                if (strlen($password) > 7) {
                  if ($password == $con_password) {
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    $result = mysqli_query($conn, "INSERT INTO `students`(`fname`, `lname`, `email`, `roll`, `req`, `username`, `phone`, `password`, `status`) VALUES ('$fname','$lname' ,'$email','$roll','$req','$username','$phone','$password_hash', '0')");
                    if ($result) {
                      $success = "Data Insert success!";
                    }
                    else {
                      $in_error = "Opps!! Something Wrong!";
                    }
                  }
                  else {
                    $password_match_err = "Password must be matched.";
                  }
                }
                else {
                  $password_len_err = "Password must have 8 or more characters.";
                }
              }
              else {
                $username_len_err = "Usename must have 8 or more characters.";
              }
            }
            else {
              $username_err = "This Username Already Taken.";
            }
          }
          else {
            $email_err = "This E-mail Already Taken.";
          }
          //echo $is_exists;
          //print_r($email_check);
        }
    }

?>

<!doctype html>
<html lang="en" class="fixed accounts sign-in">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Student Registration</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css">
    <link rel="stylesheet" href="../assets/stylesheets/css/style.css">
</head>

<body>
<div class="wrap">
    <div class="page-body animated slideInDown">
        <div class="logo">
            <h2 class="text-center">Student Registration</h2>
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

             <?php
               if(isset($email_err)) {
               ?>
               <div class="alert alert-danger alert-dismissible fade in">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 <strong><?php echo $email_err; ?></strong>
               </div>
               <?php
             }
            ?>

            <?php
              if(isset($username_err)) {
              ?>
              <div class="alert alert-danger alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php echo $username_err; ?></strong>
              </div>
              <?php
            }
           ?>

           <?php
             if(isset($username_len_err)) {
             ?>
             <div class="alert alert-danger alert-dismissible fade in">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong><?php echo $username_len_err; ?></strong>
             </div>
             <?php
           }
          ?>

          <?php
            if(isset($password_len_err)) {
            ?>
            <div class="alert alert-danger alert-dismissible fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong><?php echo $password_len_err; ?></strong>
            </div>
            <?php
          }
         ?>

         <?php
           if(isset($password_match_err)) {
           ?>
           <div class="alert alert-danger alert-dismissible fade in">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong><?php echo $password_match_err; ?></strong>
           </div>
           <?php
         }
        ?>
        </div>
        <div class="box">
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?= isset($fname) ? $fname : ''; ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                              if(isset($input_errors['fname'])) {
                                echo '<span style="color:red;">'.$input_errors['fname'].'</span>';
                              }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?= isset($lname) ? $lname : ''; ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                              if(isset($input_errors['lname'])) {
                                echo '<span style="color:red;">'.$input_errors['lname'].'</span>';
                              }
                            ?>
                        </div>

                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?= isset($email) ? $email : ''; ?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <?php
                              if(isset($input_errors['email'])) {
                                echo '<span style="color:red;">'.$input_errors['email'].'</span>';
                              }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="roll" placeholder="Roll Number" pattern="[0-9]{6}" value="<?= isset($roll) ? $roll : ''; ?>">
                                <i class="fa fa-list-ol"></i>
                            </span>
                            <?php
                              if(isset($input_errors['roll'])) {
                                echo '<span style="color:red;">'.$input_errors['roll'].'</span>';
                              }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="req" placeholder="Registration Number" pattern="[0-9]{10}" value="<?= isset($req) ? $req : ''; ?>">
                                <i class="fa fa-list-ol"></i>
                            </span>
                            <?php
                              if(isset($input_errors['req'])) {
                                echo '<span style="color:red;">'.$input_errors['req'].'</span>';
                              }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="username" placeholder="Username" value="<?= isset($username) ? $username : ''; ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                              if(isset($input_errors['username'])) {
                                echo '<span style="color:red;">'.$input_errors['username'].'</span>';
                              }
                            ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" name="phone" placeholder="Phone Number" pattern="01[1|5|6|7|8][0-9]{8}" value="<?= isset($phone) ? $phone : ''; ?>">
                                <i class="fa fa-phone"></i>
                            </span>
                            <?php
                              if(isset($input_errors['phone'])) {
                                echo '<span style="color:red;">'.$input_errors['phone'].'</span>';
                              }
                            ?>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <i class="fa fa-key"></i>
                            </span>
                            <?php
                              if(isset($input_errors['password'])) {
                                echo '<span style="color:red;">'.$input_errors['password'].'</span>';
                              }
                            ?>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" name="confirm-password" placeholder="Confirm Password">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" name="submit" value="Register">
                        </div>
                        <div class="form-group text-center">
                            Have an account? <a href="login.php">Sign In</a>
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
