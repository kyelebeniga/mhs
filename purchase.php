<?php
    @include 'config.php'
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
                <p name="user">Name: Kyele</p>
                <label for="seats">Seat:</label>
                <select name="seats" id="seats">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
                <div class="buttons">
                    <input type="submit" class="btn" name="purchase" value="Purchase">
                    <a href="tickets.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
        <div class="movie-info">
            <img src="uploaded_img/batman.jpg" height="200" width="133" alt="">
            <p class="title">The Batman</p>
            <p class="desc">Batman ventures into Gotham City's underworld when a 
                sadistic killer leaves behind a trail of cryptic clues. As the evidence begins 
                to lead closer to home and the scale of the perpetrator's plans become clear, 
                he must forge new relationships, unmask the culprit and bring justice to the abuse 
                of power and corruption that has long plagued the metropolis.
            </p>
        </div>
    </div>
</body>
</html>
