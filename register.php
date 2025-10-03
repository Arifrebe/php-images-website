<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mygalery | Register</title>

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
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-8 col-xl-6">
          <div class="card rounded-3">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-3 text-center">Register</h3>
              <form method="post" enctype='multipart/form-data'>
              <?php
                include "config.php"; 

                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $email    = $_POST['email'];
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    if(empty($username) or empty($email) or empty($password)){
                      echo"<div class='alert alert-danger'>Ada yang kosong</div>";
                    }
                    
                    $emailcheck = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
                    $usernamecheck = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

                    if(mysqli_num_rows($emailcheck) > 0){
                        echo "<div class='alert alert-danger'>Email telah digunakan</div>";
                    } elseif(mysqli_num_rows($usernamecheck) > 0){
                        echo "<div class='alert alert-danger'>Username telah digunakan</div>";
                    }

                    if($_FILES['profile']['error'] === 4){
                        echo"<div class='alert alert-danger'>Gambar tidak ada</div>";
                    }else{
                        $namaprofile=$_FILES['profile']['name'];
                        $sizeprofile=$_FILES['profile']['size'];
                        $tmpprofile=$_FILES['profile']['tmp_name'];

                        $validprofileekstensi = ['jpg', 'jpeg','png'];
                        $ekstensiprofile = explode('.', $namaprofile);
                        $ekstensiprofile = strtolower(end($ekstensiprofile));
                        
                        if(!in_array($ekstensiprofile, $validprofileekstensi)){
                            echo"<div class='alert alert-danger'>Ekstensi gambar tidak diterima</div>";
                        } elseif ($sizeprofile > 10000000) { // Adjusted file size limit
                            echo"<div class='alert alert-danger'>Gambar terlalu besar</div>";
                        } else {
                            $profilebaru = uniqid();
                            $profilebaru .= '.' . $ekstensiprofile;
                            $profilepath = 'profile/' . $profilebaru; // Initialized $profilepath

                            move_uploaded_file($tmpprofile, 'profile/'. $profilebaru);
                            $query = mysqli_query($koneksi, "INSERT INTO users (username, profile_image, email, password) VALUES ('$username','$profilepath', '$email', '$password')");

                            if(!$query){
                                echo"<div class='alert alert-danger'>User gagal ditambahkan</div>";
                            }else{
                                header('location:login.php');
                            }
                        }
                    }
                }
              ?>
                  <div class="container">
                      <div class="row justify-content-center">
                          <div class="col-4">
                              <div class="text-center mb-5 mt-2">
                                  <div class="user-img position-relative" id="profile">
                                      <img src="asset/image/profile.jpg" id="photo" class="img-fluid rounded-circle shadow">
                                      <input type="file" name="profile" id="file" class="d-none" accept="image/*">
                                      <label for="file" id="uploadbtn" class="position-absolute rounded-circle bg-secondary text-white">
                                          <i class="fas fa-camera"></i>
                                      </label>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                  </div>
                  <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                  </div>
                  <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password required">
                  </div>
                  <div class="d-flex align-items-center justify-content-between">
                      <button type="submit" name="submit" class="btn btn-primary">Register</button>
                      <p>Sudah punya akun? <a href="login.php">Login</a></p>
                  </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Get DOM elements
    var imgDiv = document.querySelector('.user-img');
    var img = document.querySelector('#photo');
    var file = document.querySelector('#file');
    var uploadbtn = document.querySelector('#uploadbtn');

    // Add event listener to file input
    file.addEventListener('change', function(event) {
        var chosenFile = event.target.files[0];
        if (chosenFile) {
            var reader = new FileReader();
            reader.onload = function(e) {
                img.setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(chosenFile);
        }
    });
});

  </script>
</html>