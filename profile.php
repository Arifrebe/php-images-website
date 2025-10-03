<?php
    session_start();

    include "config.php";


    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = $id";
    $post = mysqli_query($koneksi,"SELECT * FROM post WHERE user_id = $id");
    $result = mysqli_query($koneksi, $query);
    $jumlah = mysqli_num_rows($post);
    $result = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mygalery | Profile</title>

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
        <div class="card border-0 overflow-hidden pb-3">
            <div class="card-body p-0">
              <div class="row align-items-center">
                <div class="col-lg-4 order-lg-1 order-2">
                  <div class="d-flex align-items-center justify-content-around m-4">
                    <div class="text-center">
                      <i class="fa fa-file fs-6 d-block mb-2"></i>
                      <h4 class="mb-0 fw-semibold lh-1"><?php echo $jumlah; ?></h4>
                      <p class="mb-0 fs-4">Posts</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                    <div class="mt-n5">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle" style="width: 110px; height: 110px;">
                                <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden" style="width: 100px; height: 100px;">
                                    <img src="<?php echo $result['profile_image']; ?>" alt="Profile Image" class="w-100 h-100">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="fs-5 mb-0 fw-semibold"><?php echo $result['username']; ?></h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 order-last">
                  
                </div>
              </div>
            </div>
        </div>
        <div class="post">
            <div class="row mb-4">
                <div class="col-6">
                    <h3>Post</h3>
                </div>
                <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id): ?>
                    <div class="col-6 text-end">
                        <a href="tambah.php" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                    </div>
                <?php endif; ?>

            </div>
            <?php
                if($jumlah < 1){
                    echo "<div class='text-center alert alert-info'>Tidak ada post</div>";
                }else{
            ?>
            <div id="main">
                <?php
                    foreach($post as $data){
                ?>
                <div class="box">
                    <a href="image-detail.php?id=<?php echo $data['id'];?>"><img src="<?php echo $data['image'] ; ?>" alt="" srcset=""></a>
                </div>
                <?php } ?>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/script.js" defer></script>
  </body>
</html>