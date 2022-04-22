<?php
    $conn = mysqli_connect('localhost', 'root', '', 'mhs_db');

    session_start();
    
    $id = $_POST['path'];
    mysqli_query($conn, "DELETE FROM movie WHERE movieid = $id");    
?>