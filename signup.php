<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/notify.js"></script>
    <title>MHS | Register</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section class="main">
        <div class="login-container">
            <h1>Signup</h1>
            <form method="post" class="login">
                <input type="text" id="user" name="user" class="user" placeholder="Username">
                <input type="password" id="pass" name="pass" class="pass" placeholder="Password">
                <input type="submit" class="btn" name="submit_login" value="Signup">
                <p><a href="login.php">Cancel</a></p>
            </form>
        </div>
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
                    var formValues= $(this).serialize();
            
                    $.post("php/signup.php", formValues, function(data){
                    $('.btn').notify('Success!', 'success',);
                        setTimeout(function() { 
                            window.location.href = 'login.php'; 
                        }, 2000);
                    });
                }
            });
        });
    </script>
</body>
</html>