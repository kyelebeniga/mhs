<?php
    $conn = mysqli_connect('localhost', 'root', '', 'mhs_db');

    session_start();

    $username = $_POST['user'];
    $password = $_POST['pass'];

    $mysql = "SELECT * FROM registration WHERE username='".$username."'";
    $result = mysqli_query($conn, $mysql);
    $row = mysqli_fetch_array($result);
    $verify = password_verify($password, $row['password']);
    
    if($verify==1){
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        echo "success";
    }
    else{
        echo "fail";
    }
?>