<?php

session_start();

// Cek apakah user sudah login atau belum
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// Ambil data di URL
$id = $_GET["id"];

// Query data berdasarkan ID
$data_cerita = query("SELECT * FROM cerita_rakyat WHERE id = $id")[0];

// Apakah $_POST dengan key "submit" sudah pernah dibuat (diklik) belum
if(isset($_POST["submit"])) {

    // Cek apakah data berhasil diubah atau tidak
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah');
                document.location.href = 'index-2.php';
            </script>
            
        ";
    } else {
        echo "
            <script>alert('Data gagal diubah');</script>
        ";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Form Ubah Data</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<style>
    h1 {
        text-align: center;
        margin-top: 20px;
    }
    body {
        background-image: linear-gradient(45deg, #8fb2f2, #dce6f7);
    }
    form {
        padding: 50px;
    }
    .button-form {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .container {
        margin: 27px auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, .2);
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 10px;
        background-color: white;
        width: 600px;
    }
    .navbar-brand {
        cursor: pointer;
    }
    img {
        border-radius: 5px;
    }
    .ubah-button {
        background-image: linear-gradient(90deg, #387bf5, #6c9cf5, #8fb2f2, #c0d5fc);
        border: none;
        border-radius: 5px;
        color: white;
        font-weight: 500;
    }
    .ubah-button:hover {
        color: black;
        font-weight: 500;
    }
    .balik-link {
        background-image: linear-gradient(90deg, #595b5e, #919499);
        border: none;
        border-radius: 5px;
        color: white;
        font-weight: 500;
    }
</style>

<body>
<!-- Bagian Navbar -->
<nav class="navbar bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" style="font-weight: 600; font-size:25px;"><i class="bi bi-book-fill"></i> Indonesian Folklore.</a>
        <div class="navbar-link">
            <a class="navbar-brand" href="#"><i class="bi bi-person-fill person-icon"></i> <?php echo $_SESSION["username"]; ?></a>
            <a class="navbar-brand" href="logout.php" onclick="return confirm('Apakah mau logout?');">Logout</a>
        </div>
    </div>
</nav>

<!-- Bagian Form Ubah Cerita -->
<div class="container">
    <h1>Ubah Cerita</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <!-- ini biar id ga keliatan di user, tapi data tetap terkirim -->
        <input type="hidden" name="id" value="<?= $data_cerita["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $data_cerita["gambar"]; ?>">

        <b><label for="judul" class="form-label">Judul Cerita</label></b>
        <input type="text" id="judul" class="form-control" name="judul" required value="<?= $data_cerita["judul"]; ?>">

        <b><label for="asal_cerita" class="form-label mt-3">Asal Cerita</label></b>
        <input type="text" id="asal_cerita" class="form-control" name="asal_cerita" required value="<?= $data_cerita["asal_cerita"]; ?>">

        <b><label for="jenis_cerita" class="form-label mt-3">Jenis Cerita</label></b>
        <input type="text" id="jenis_cerita" class="form-control" name="jenis_cerita" required value="<?= $data_cerita["jenis_cerita"]; ?>">

        <b><label for="gambar" class="form-label mt-3">Gambar</label></b><br>
        <img src="img/<?= $data_cerita["gambar"]; ?>" alt="">
        <input type="file" id="gambar" class="form-control" name="gambar">

        <div class="button-form mt-5">
            <button type="submit" class="btn mt-3 ubah-button" name="submit">Ubah Data</button>
            <a class="btn btn-outline-primary mt-3 balik-link" href="index-2.php" role="button">Balik ke Halaman Utama</a>
        </div>
    </form>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</body>
</html>