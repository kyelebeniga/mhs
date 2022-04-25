<?php
    @include 'config.php';
    session_start();

    $movieid = $_GET['movieid'];

    $select = mysqli_query($conn, "SELECT * FROM movie WHERE movieid='$movieid'");
    $row = mysqli_fetch_assoc($select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta charset="UTF-8">
    <title>MHS | Purchase</title>
    <link rel="stylesheet" href="css/purchase.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/notify.js"></script>
</head>
<body>
    <div class="main-container">
        <div class="checkout">
            <h1>Checkout</h1>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form-container" id="myForm">
                <input type="text" placeholder="First Name" name="first_name" class="text-form" id="first_name">
                <input type="text" placeholder="Last Name" name="last_name" class="text-form" id="last_name">
                <label for="seats">Seat:</label>
                <select name="seats" id="seats">
                    <option value=""></option>
                    <?php 
                        $tbl = array();
                        $reserved = mysqli_query($conn, "SELECT seat FROM purchases WHERE movieid='$movieid'");
                        while($res = mysqli_fetch_assoc($reserved)){  
                            $tbl[] = $res['seat'];
                        };
                        for($i=1;$i<=50;$i++){
                            if(!in_array($i, $tbl)){  //Makes already reserved seats hidden from dropdown menu
                                echo "<option value='$i'>$i</option>";
                            }
                        }
                    ?>
                </select>
                <div class="buttons">
                    <input type="submit" id="<?php echo $movieid; ?>" class="btn" name="purchase" value="Purchase">
                    <a href="tickets.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
            <p class="amount">Price: $<?php echo $row['price']?></p>
        </div>
        <div class="movie-info">
            <img src="uploaded_img/<?php echo $row['image']; ?>" height="200" width="133" alt="">
            <p class="title"><?php echo $row['title']; ?></p>
            <p class="desc"><?php echo $row['description']; ?></p>
        </div>
    </div>
    <script src="js/purchaseMovie.js"></script>
</body>
</html>
