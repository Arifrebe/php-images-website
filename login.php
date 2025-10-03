

<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mygalery | Login</title>

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
  <section class="vh-100 h-custom" style="background-color: #1f80db;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-8 col-xl-6">
          <div class="card rounded-3">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-3 text-center">Login</h3>
              <form method="post">
              <?php
                  include "config.php";

                  if(isset($_POST['submit'])){
                      $email = $_POST['email'];
                      $password =$_POST['password'];

                      $query = "SELECT * FROM users WHERE email='$email'";
                      $result = mysqli_query($koneksi, $query);

                      if(mysqli_num_rows($result) == 1) {
                          $user = mysqli_fetch_assoc($result);
                          if (password_verify($password, $user['password'])) {
                              // Start session and store user information
                              session_start();
                              $_SESSION['user_id'] = $user['id']; 

                              // Redirect to dashboard or some other page
                              header("Location: index.php");
                              exit;
                          } else {
                              echo "<div class='alert alert-danger'>Email atau password salah, silahkan coba lagi.</div>";
                          }
                      } else {
                          echo "<div class='alert alert-danger'>Email tidak ditemukan.</div>";
                      }
                  }
                ?>


                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="email" required>
                </div>
                <div class="mb-3">
                  <label for="Password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="Password" placeholder="Password" required>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                  <button type="submit"name="submit" class="btn btn-primary">Login</button>
                  <p>Belum punya akun?<a href="register.php">register</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/script.js" defer></script>
  </body>
</html>