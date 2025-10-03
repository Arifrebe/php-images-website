<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mygalery | Detail</title>
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
        include 'config.php';
    ?>

   
    <div class="container-xl my-3">
        <div class="card-detail">
            <div class="row">
            <?php
                $id = $_GET['id'];
                $data=mysqli_query($koneksi,"SELECT * FROM post WHERE id='$id';");
                $data = mysqli_fetch_assoc($data);
                $author_id = $data['user_id'];
                $author = mysqli_query($koneksi,"SELECT * FROM users WHERE id='$author_id';");
                $author = mysqli_fetch_assoc($author);
            ?>
                <div class="col-lg-5 col-12">
                    <div class="image">
                        <img src="<?php echo $data['image'] ?>" alt="" srcset="" width="100%" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-7 p-5">
                    <h3><?php echo $data['title'] ?></h3>
                    <p><?php echo $data['description'] ?></p>
                    <a href="profile.php?id=<?php echo $author_id ?>" style="text-decoration:none;">
                        <div class="author-card">
                            <img src="<?php echo $author['profile_image'] ?>" alt="Author">
                            <div class="author-info">
                                <h2><?php echo $author['username'] ?></h2>
                                <p>Author</p>
                            </div>
                        </div>
                    </a>
                    <!-- Button wrapper -->
                    <div class="card-footer mt-5">
                        <?php
                            if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $author_id) {
                                echo '<a href="edit.php?id=' . $id . '" class="btn btn-success me-2">Edit</a>';
                                echo '<a href="hapus.php?id=' . $id . '" class="btn btn-danger">Hapus</a>';
                            }
                        ?>
                        <button class="btn btn-primary">Download</button>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/script.js" defer></script>
  </body>
</html>