<?php

session_start();

// Koneksi ke database
require 'functions.php';

// Cek apakah user sudah login atau belum
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


$cerita = query("SELECT * FROM cerita_rakyat");

// Tombol cari ditekan
if (isset($_POST["cari"])) {
    $cerita = cari($_POST["keyword"]);
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
    
    <title>Halaman Admin</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<style>
    body {
        font-family: "Poppins";
        background-image: linear-gradient(45deg, #8fb2f2, #dce6f7);
    }
    h1 {
        text-align: center;
    }
    .h1-judul {
        padding: 20px;
    }
    .container {
        margin: 40px auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, .2);
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 10px;
        background-color: white;
        width: 600px;
    }
    #list-tabel {
        padding: 20px 50px;
        margin-bottom: 30px;
    }
    table {
        text-align: center;
    }
    .button-tambah {
        text-align: center;
    }
    .mb-3 {
        padding: 0 20px;
    }
    .keyword-cari {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        margin-bottom: 10px;
    }
    img {
        border-radius: 5px;
    }
    .loader {
        width: 200px;   
        display: none;
    }
    .tambah-link {
        background-image: linear-gradient(90deg, #387bf5, #6c9cf5, #8fb2f2, #c0d5fc);
        width: 300px;
        border: none;
        border-radius: 50px;
        color: white;
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

<!-- Bagian Tambah dan Cari Cerita -->
<div data-aos="fade-down" data-aos-duration="500" data-aos-easing="ease-in-sine" class="container">
    <div class="h1-judul">
        <h1>List Cerita Indonesia</h1>
    </div>

    <div class="button-tambah">
        <a href="tambah.php" class="btn btn-primary tambah-link" role="button">Tambah List Cerita</a>
    </div>
    <br>
    <br>

    <form action="" method="post">
        <div class="keyword-cari">
            <div class="col-12 mb-3">
                <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Cari Judul, Asal Cerita, atau Jenis Cerita" autofocus autocomplete="off">
                <!-- autofocus: ketika masuk ke web, nanti inputnya bakal nyala -->
            </div>
        </div>
        <center><img src="img/loader.gif" class="loader" alt="loader"></center>
    </form>
</div>

<!-- Bagian Tabel -->
<div id="list-tabel">
    <table class="table table-success table-striped-columns">
        <thead>
            <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Aksi</th>
                <th scope="col">Gambar</th>
                <th scope="col">Judul</th>
                <th scope="col">Asal Cerita</th>
                <th scope="col">Jenis Cerita</th>
            </tr>
        </thead>

        <?php $i = 1; ?>
        <?php foreach($cerita as $baris) : ?>
        <tbody>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <a href="ubah.php?id=<?= $baris["id"]; ?>">Ubah</a> |
                    <a href="hapus.php?id=<?= $baris["id"]; ?>" onclick="return confirm('Apakah mau dihapus?');">Hapus</a>
                </td>
                <td>
                    <img src="img/<?= $baris["gambar"]; ?>" alt="">
                </td>
                <td><?= $baris["judul"]; ?></td>
                <td><?= $baris["asal_cerita"]; ?></td>
                <td><?= $baris["jenis_cerita"]; ?></td>
            </tr>
        </tbody>
        <?php $i++; ?>
        <?php endforeach; ?>

    </table>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>