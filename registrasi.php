<?php 

require 'functions.php';

if(isset($_POST["register"])) {

    if(registrasi($_POST) > 0) {
        echo "
            <script>alert('User baru berhasil ditambahkan');</script>
        ";
    } else {
        echo mysqli_error($con);
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
    
    <title>Halaman Registrasi</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
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
        justify-content: center;
        text-align: center;
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
    .registrasi-button {
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
    </div>
</nav>

<!-- Bagian Form Registrasi -->
<div data-aos="fade-down" data-aos-duration="500" data-aos-easing="ease-in-sine" class="container">
    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
        <div class="mb-2">
            <b><label for="exampleFormControlInput1" class="form-label">Username</label></b>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="username" placeholder="Masukkan Username" autofocus>
        </div>
        <div class="mb-3">
            <b><label for="inputPassword5" class="form-label">Password</label></b>
            <input type="password" id="inputPassword5" class="form-control" name="password" aria-describedby="passwordHelpBlock" placeholder="Masukkan Password">
        </div>
        <div class="mb-3">
            <b><label for="inputConfirmationPassword5" class="form-label">Konfirmasi Password</label></b>
            <input type="password" id="inputConfirmationPassword5" class="form-control" name="password2" aria-describedby="passwordHelpBlock" placeholder="Masukkan Konfirmasi Password">
        </div>
        <div class="login-link">
            <p>Sudah punya akun? <a href="login.php"><b>Masuk</b></a> disini</p>
        </div>
        <div class="button-form">
            <button type="submit" class="btn mt-3 registrasi-button" name="register"><b>Daftar</b></button>
        </div>
    </form>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>