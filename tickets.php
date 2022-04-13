<?php
    @include 'config.php';
    session_start();

    $select = mysqli_query($conn, "SELECT * FROM movie");
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
        <a href="#" class="logo">MHS</a>
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
    <div class=content>
        <h1>Now Showing</h1>
        <div class="column">
            <?php while($row = mysqli_fetch_assoc($select)){ ?>
                <div class="column">
                    <a href="movie_page.php?movie_id=<?php echo $row['movieid']; ?>">
                        <img src="uploaded_img/<?php echo $row['image']; ?>">
                        <p><?php echo $row['title']; ?></p>
                    </a>
                </div>
            <?php }; ?>
        </div>
    </div>

    <!--Navbar JavaScript-->
    <script>
        window.addEventListener("scroll", function(){
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
</body>
</html>
