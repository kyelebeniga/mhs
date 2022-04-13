<?php
    @include 'config.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta charset="UTF-8">
    <title>MHS | Purchase Tickets</title>
    <link rel="stylesheet" href="css/tickets.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <header>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#" class="current-page">Movies</a></li>
            <li><a href="#"><?php echo $_SESSION['username']; ?></a>
                <ul>
                    <li><a href="history.php">History</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>
    <section class="main">
        <!--Movie Table-->
        <section class="movie-list">
        <?php
            $select = mysqli_query($conn, "SELECT * FROM movie")
        ?>
        <div class="movie-display">
        <h1>Purchase Tickets</h1>
            <table class="movie-table">
                <thead>
                    <tr>
                        <th>Poster</th>
                        <th>Title</th>
                        <th class="table-desc">Description</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <!--Populate Movie Table-->
                <?php while($row = mysqli_fetch_assoc($select)){ ?>
                    <tr>
                        <td><a href="movie_page.php?movie_id=<?php echo $row['movieid']; ?>"><img src="uploaded_img/<?php echo $row['image']; ?>" height="300" width="200" alt=""></a></td>
                        <td><a href="movie_page.php?movie_id=<?php echo $row['movieid']; ?>"><?php echo $row['title'] . '<br>$' .$row['price']; ?></a></td>
                        <td class="table-desc-content"><?php echo $row['description']; ?></td>
                        <td>
                            <a href="purchase.php?movieid=<?php echo $row['movieid']; ?>" class="btn"><i class="fa-solid fa-cart-shopping"></i>Purchase</a>
                        </td>
                    <tr>
                <?php }; ?>
            </table>
        </div>
    </section>

    <!--Navbar JavaScript-->
    <script>
        window.addEventListener("scroll", function(){
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
</body>
</html>
