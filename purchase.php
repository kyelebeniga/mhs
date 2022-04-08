<?php
    @include 'config.php';

    $id = $_GET['movieid'];

    session_start();
    if(isset($_POST['purchase'])){
        $username = $_SESSION['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $seat = $_POST['seats'];

        if(empty($first_name) || empty($last_name) || empty($seat)){
            echo "<script type='text/javascript'>alert('Please fill out all the blanks!');</script>";
        }
        else{
            $insert = "INSERT INTO purchases(movie, username, fname, lname, seat) VALUES('$id', '$username', '$first_name', '$last_name', '$seat');";
            $upload = mysqli_multi_query($conn, $insert);
            if($upload){
                echo "<script>
                    alert('Ticket purchased!');
                    window.open('tickets.php','_self');
                </script>";
            }
            else{
                echo "<script type='text/javascript'>alert('Error!');</script>";
            }
        }
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MHS | Purchase</title>
    <link rel="stylesheet" href="css/purchase.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <div class="main-container">
        <div class="checkout">
            <h1>Checkout</h1>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form-container">
                <input type="text" placeholder="First Name" name="first_name" class="text-form">
                <input type="text" placeholder="Last Name" name="last_name" class="text-form">
                <label for="seats">Seat:</label>
                <select name="seats" id="seats">
                    <option value=""></option>
                    <script>
                        for(var i=1;i<=50;i++){
                            document.write("<option value="+i+">"+i+"</option>");
                        }   
                    </script>
                </select>
                <div class="buttons">
                    <input type="submit" class="btn" name="purchase" value="Purchase">
                    <a href="tickets.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
        <div class="movie-info">
            <?php
                $select = mysqli_query($conn, "SELECT * FROM movie WHERE id='$id'");
                $row = mysqli_fetch_assoc($select);
            ?>
            <img src="uploaded_img/<?php echo $row['image']; ?>" height="200" width="133" alt="">
            <p class="title"><?php echo $row['title']; ?></p>
            <p class="desc"><?php echo $row['description']; ?></p>
        </div>
    </div>
</body>
</html>
