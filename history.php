<?php
    @include 'config.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta charset="UTF-8">
    <title>MHS | History</title>
    <link rel="stylesheet" href="css/history.css">
</head>
<body>
    <header>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="tickets.php">Movies</a></li>
            <li><a href="#"><?php echo $_SESSION['username']; ?></a>
                <ul>
                    <li><a href="#">History</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>
    <div class="main-contianer">
        <div class="movie-display">
        <h1>History</h1>
            <table class="movie-table">
                <thead>
                    <tr>
                        <th class="table-poster">Poster</th>
                        <th>Title</th>
                        <th class="table-desc">Description</th>
                        <th>Seat</th>
                    </tr>
                </thead>
                <!--Populate Movie Table-->
                <?php
                    $username = $_SESSION['username'];
                    $select = mysqli_query($conn, "SELECT * FROM movie, purchases WHERE movie.movieid=purchases.movieid AND purchases.username='$username'");
                ?>
                <?php while($row = mysqli_fetch_assoc($select)){ ?>
                    <tr>
                        <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="300" width="200" alt=""></td>
                        <td><?php echo $row['title'] . '<br>$' .$row['price']; ?></td>
                        <td class="table-desc-content"><?php echo $row['description']; ?></td>
                        <td><?php echo $row['seat']?></td>
                    <tr>
                <?php }; ?>
            </table>
        </div>
    </div>
    <script>
        window.addEventListener("scroll", function(){
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
</body>
</html>