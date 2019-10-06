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
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Roll</th>
                        <th>Reg. No</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        $result = mysqli_query($conn, "SELECT * FROM `students`");
                        while ($row = mysqli_fetch_assoc($result)) {
                          ?>
                          <tr>
                            <td><?= ucwords($row['fname']." ".$row['lname']); ?></td>
                            <td><?= $row['email'];  ?></td>
                            <td><?= $row['roll'];  ?></td>
                            <td><?= $row['req'];  ?></td>
                            <td><?= $row['username'];  ?></td>
                            <td><?= $row['phone'];  ?></td>
                            <td>
                              <img src="<?= $row['image'];  ?>" alt="std_picture">
                            </td>
                            <td><?= $row['status'] == 1 ? 'Active' : 'Inactive';  ?></td>
                            <td>
                              <?php
                                if ($row['status'] == 1) {
                                  ?>
                                    <a class="btn btn-success" href="status_inactive.php?id=<?= base64_encode($row['id']); ?>"><i class="fa fa-arrow-up"></i></a>
                                  <?php
                                }
                                else {
                                  ?>
                                  <a class="btn btn-danger" href="status_active.php?id=<?= base64_encode($row['id']); ?>"><i class="fa fa-arrow-down"></i></a>
                                  <?php
                                }
                              ?>


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
  include 'footer.php';
?>
