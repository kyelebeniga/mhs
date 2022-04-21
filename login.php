<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta charset="UTF-8">
    <title>MHS | Login</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/notify.js"></script>
</head>
<body>
    <section class="main">
        <div class="login-container">
            <h1>Login</h1>
            <form method="post" class="login">
                <input type="text" id="user" name="user" class="user" placeholder="Username">
                <input type="password" id="pass" name="pass" class="pass" placeholder="Password">
                <input type="submit" class="btn" name="submit_login" value="Login">
                <p>Not a member? <a href="signup.php">Signup now</a></p>
            </form>
        </div>
        <p id="response"></p>
    </section> 
    <script>
        $(document).ready(function(){
            $("form").on("submit", function(e){
                e.preventDefault();

                var username = $('#user').val();
                var password = $('#pass').val();
                
                if(username == ''){
                    $('.user').notify('Empty username.',
                        {position: 'right'}
                    );
                }
                else if(password == ''){
                    $('.pass').notify('Empty password.',
                        {position: 'right'}
                    );
                }
                else{
                    $.ajax({
                        url: 'php/login.php',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response){
                            if(response=="success"){
                                window.location = 'index.php';
                            }
                            else{
                                $('.btn').notify("Invalid credentials.", {position: 'bottom center'});
                            }
                        },
                        dataType: 'text'
                    });
                }
            })
        })
    </script>
</body>
</html>