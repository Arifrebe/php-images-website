<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mygalery | Beranda</title>

    <!-- Plain CSS -->
    <link rel="stylesheet" href="asset/style.css" />
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap 5.3 CSS-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Unicons CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  </head>
  <body>
    <?php
    include 'parts/navbar.php';
    ?>

   
    <div class="container-xl">
        <div id="main">
            <?php 
                include "config.php";

                $query = mysqli_query($koneksi,"SELECT * FROM post");

                foreach($query as $data){
            ?>
            <div class="box">
                <a href="image-detail.php?id=<?php echo $data['id'];?>"><img src="<?php echo $data['image'] ; ?>" alt="" srcset=""></a>
            </div>
            <?php } ?>
        </div>
    </div>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/script.js" defer></script>
  </body>
</html>