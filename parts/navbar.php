<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-3 px-5" >
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MyPictures</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link" href="index.php?page=beranda">Beranda</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="tambah.php?page=buat">Buat</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-2 mb-lg-0">
                    <li class="nav-item dropdown dropstart">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <!-- User is logged in -->
                            <li><a class="dropdown-item" href="profile.php?id=<?php echo $_SESSION['user_id']; ?>">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        <?php else: ?>

                            <!-- User is not logged in -->
                            <li><a class="dropdown-item" href="login.php">Login</a></li>
                        <?php endif; ?>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>