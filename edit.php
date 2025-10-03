<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mygalery | Edit</title>

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
                <?php
                    $id = $_GET['id'];
                    $query = mysqli_query($koneksi,"SELECT * FROM post WHERE id=$id");
                    $query = mysqli_fetch_assoc($query);

                    if(isset($_POST['submit'])){
                        if (isset($_SESSION['user_id'])) {
                            $user_id = $_SESSION['user_id'];
                        }
                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        $oldImagePath = $post['image'];

                        if(empty($_FILES['image']['name']) || empty($_FILES['image']['tmp_name']) || $_FILES['image']['error'] == 4){
                            $imagepath = $oldImagePath;
                        } else {
                            $namaimage=$_FILES['image']['name'];
                            $sizeimage=$_FILES['image']['size'];
                            $tmpimage=$_FILES['image']['tmp_name'];

                            $validimageekstensi = ['jpg', 'jpeg','png'];
                            $ekstensiimage = explode('.', $namaimage);
                            $ekstensiimage = strtolower(end($ekstensiimage));
                            
                            if(!in_array($ekstensiimage, $validimageekstensi)){
                                echo "<div class='alert alert-danger'>Ekstensi gambar tidak diterima</div>";
                            } elseif ($sizeimage > 10000000) {
                                echo "<div class='alert alert-danger'>Gambar terlalu besar</div>";
                            } else {
                                if (file_exists($oldImagePath)) {
                                    unlink($oldImagePath);
                                }

                                $imagebaru = uniqid();
                                $imagebaru .= '.' . $ekstensiimage;
                                $imagepath = 'posts/' . $imagebaru;

                                move_uploaded_file($tmpimage, 'posts/'. $imagebaru);
                            }
                        }

                        $query = mysqli_query($koneksi, "UPDATE post SET title='$title', description='$description', image='$imagepath' WHERE id=$id");
                
                        if(!$query){
                            echo "<div class='alert alert-danger'>Postingan gagal diperbarui</div>";
                        } else {
                            header("location:image-detail.php?id=$id");
                        }
                    }
                ?>
            <form method="post" enctype='multipart/form-data'>
                <div class="row">
                    <div class="col-lg-5 col-12">
                        <div class="container">
                            <div class="row justify-content-end">
                                <label for="image-input" class="col-auto custom-file-label mt-3"><i class="fas fa-plus"></i></label>
                                <input type="file" id="image-input" name="image" class="custom-file-input" accept="image/*" style="display: none;">
                            </div>
                            <div class="row justify-content-center">
                                <img id="image-preview" src="<?php echo $query['image']; ?>" alt="Image Preview">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 py-3 px-5">
                        <h3 class="mb-3">Postingan</h3>
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="title" id="title" value="<?php echo $query['title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi <label for="" class="text-muted">(maksimal 150 karakter)</label></label>
                                <textarea class="form-control" name="description" maxlength="150" id="deskripsi" rows="3" required><?php echo $query['description']; ?></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>        
            </form>
        </div>
    </div>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/script.js" defer></script>
  </body>
</html>