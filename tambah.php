<?php
    session_start();
    include 'config.php'; // koneksi db

    if(isset($_POST['submit'])){
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            // Jika belum login, arahkan ke login
            header("Location: login.php");
            exit;
        }
        
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        if($_FILES['image']['error'] === 4){
            echo"<div class='alert alert-danger'>Gambar tidak ada</div>";
        }else{
            $namaprofile = $_FILES['image']['name'];
            $sizeprofile = $_FILES['image']['size'];
            $tmpprofile = $_FILES['image']['tmp_name'];

            $validprofileekstensi = ['jpg', 'jpeg','png'];
            $ekstensiprofile = explode('.', $namaprofile);
            $ekstensiprofile = strtolower(end($ekstensiprofile));
            
            if(!in_array($ekstensiprofile, $validprofileekstensi)){
                echo"<div class='alert alert-danger'>Ekstensi gambar tidak diterima</div>";
            } elseif ($sizeprofile > 10000000) { 
                echo"<div class='alert alert-danger'>Gambar terlalu besar</div>";
            } else {
                $profilebaru = uniqid();
                $profilebaru .= '.' . $ekstensiprofile;
                $profilepath = 'posts/' . $profilebaru;

                move_uploaded_file($tmpprofile, $profilepath);

                $query = mysqli_query($koneksi, "INSERT INTO post 
                    VALUES ('','$user_id', '$title', '$description','$status','$profilepath')");

                if(!$query){
                    echo"<div class='alert alert-danger'>Postingan gagal ditambahkan</div>";
                }else{
                    header("Location: profile.php?id={$_SESSION['user_id']}");
                    exit;
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mygalery | Tambah</title>

    <link rel="stylesheet" href="asset/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>

<body>
    <?php include 'parts/navbar.php'; ?>

    <div class="container-xl my-3">
        <div class="card-detail">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-5 col-12">
                        <div class="container">
                            <div class="row justify-content-end">
                                <label for="image-input" class="col-auto custom-file-label mt-3"><i
                                        class="fas fa-plus"></i></label>
                                <input type="file" id="image-input" name="image" class="custom-file-input" accept="image/*"
                                    style="display: none;">
                            </div>
                            <div class="row justify-content-center">
                                <img id="image-preview" src="asset/no-image.png" alt="Image Preview" style="max-width:100%; height:auto;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 py-3 px-5">
                        <h3 class="mb-3">Postingan</h3>

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi 
                                <span class="text-muted">(maksimal 150 karakter)</span>
                            </label>
                            <textarea class="form-control" name="description" maxlength="150" id="description" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status 
                                <span class="text-muted">(default: diarsipkan)</span>
                            </label>
                            <select class="form-select" id="status" name="status">
                                <option value="diarsipkan" selected hidden>Diarsipkan</option>
                                <option value="publish">Publish</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/script.js" defer></script>
</body>
</html>
