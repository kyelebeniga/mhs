<?php
    @include 'config.php';   

    session_start();

    $error = "";
    if(isset($_POST['submit_login'])){
        $username = $_POST['user'];
        $password = $_POST['pass'];

        if(empty($username) || empty($password)){
            $error = "Fill out all the blanks";
        }
        else{
            $mysql = "INSERT INTO registration (username, password) VALUES ('$username', '$password')";
            $result = mysqli_query($conn, $mysql);
            echo "<script type='text/javascript'></script>";

            if($result){
                echo "<script>
                    alert('Successfully registered!');
                    window.open('login.php','_self');
                </script>";
            }
            else{
                echo "<script type='text/javascript'>alert('Error signing up!');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MHS | Register</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section class="main">
        <div class="login-container">
            <h1>Signup</h1>
            <form method="post" class="login">
                <input type="text" id="user" name="user" placeholder="Username">
                <input type="password" id="pass" name="pass" placeholder="Password">
                <div><span class="error"><?php echo $error; ?></span></div>
                <input type="submit" class="btn" name="submit_login" value="Signup">
            </form>
        </div>
    </section>  
</body>
</html>