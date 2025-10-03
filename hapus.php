<?php
    session_start();
    
    include "config.php";

    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $query = mysqli_query($koneksi, "DELETE FROM post WHERE id=$id");

    if ($query) {
        header("Location: profile.php?id=" . $_SESSION['user_id']);
        exit(); // Ensure script termination after redirection
    }
?>
