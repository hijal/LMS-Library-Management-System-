<?php

$conn = mysqli_connect("localhost", "root", "", "lms_db");
mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET SESSION collation_connection = 'utf8_general_ci'");

?>
