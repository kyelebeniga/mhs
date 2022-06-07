<?php
    $conn = mysqli_connect('localhost', 'root', '', 'mhs_og_db');

    session_start();
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
    
    $mysql = "INSERT INTO registration (username, password) VALUES ('$username', '$hashedPass')";
    $result = mysqli_query($conn, $mysql);

?>