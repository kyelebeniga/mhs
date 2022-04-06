<?php
    @include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MHS | Purchase Tickets</title>
    <link rel="stylesheet" href="css/tickets.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <header>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="movies.php">Movies</a></li>
            <li><a href="#" class="current-page">Purchase Tickets</a></li>
        </ul>
    </header>
    <section class="main">
        <h1>Purchase Tickets</h1>
        <!--Movie Table-->
        <section class="movie-list">
        <?php
            $select = mysqli_query($conn, "SELECT * FROM movie")
        ?>
        <div class="class movie-display">
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
                        <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="300" width="200" alt=""></td>
                        <td><?php echo $row['title']; ?></td>
                        <td class="table-desc-content"><?php echo $row['description']; ?></td>
                        <td>
                            <button onclick="openForm()" class="btn"><i class="fa-solid fa-cart-shopping"></i> Purchase</button>
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
