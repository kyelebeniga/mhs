<?php
    @include 'config.php';   

    session_start();

// If user already logged in, send them to home page
    if ( ! empty( $_SESSION['user'] ) ) {
        header('Location:index.php?');
        exit;
    }

    $error = "";
    if(isset($_POST['submit_login'])){
        $username = $_POST['user'];
        $password = $_POST['pass'];

        $mysql = "SELECT * FROM registration WHERE username='".$username."'AND BINARY password='".$password."'";
        $result = mysqli_query($conn, $mysql);
       
        if(mysqli_num_rows($result)==1){
            $row = mysqli_fetch_array($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            header('location:index.php');
        }
        else{
            $error = "Invalid credentials.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta charset="UTF-8">
    <title>MHS | Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section class="main">
        <div class="login-container">
            <h1>Login</h1>
            <form method="post" class="login">
                <input type="text" id="user" name="user" placeholder="Username">
                <input type="password" id="pass" name="pass" placeholder="Password">
                <div><span class="error"><?php echo $error; ?></span></div>
                <input type="submit" class="btn" name="submit_login" value="Login">
                <p>Not a member? <a href="signup.php">Signup now</a></p>
            </form>
        </div>
    </section>  
</body>
</html>