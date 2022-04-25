<?php
    $conn = mysqli_connect('localhost', 'root', '', 'mhs_db');
    session_start();
    
    $movieid = $_POST['movieid'];
    $username = $_SESSION['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $seat = $_POST['seats'];
    $insert = "INSERT INTO purchases(movieid, username, fname, lname, seat) VALUES('$movieid', '$username', '$first_name', '$last_name', '$seat');";
    $upload = mysqli_query($conn, $insert);
?>