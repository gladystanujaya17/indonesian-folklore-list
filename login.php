<?php 
session_start();

require 'functions.php';


// Cek apakah user sudah login atau belum
if (isset($_SESSION["login"])) { 
    header("Location: index-2.php");
    exit;
}

if (isset($_POST["login"])) {

    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $result = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");

    // Cek username
    if (mysqli_num_rows($result) === 1) { // Hitung ada berapa baris yang dikembalikan dari $result
        
        // Cek password
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row["password"])) {
            // Ambil data username
            $_SESSION["username"] = $row["username"];

            // Set session
            $_SESSION["login"] = true;

            // Arahkan ke halaman Index
            header("Location: index-2.php");
            exit;
        }
    }

    $error = true;
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

    <title>Halaman Log In</title>

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
    .person-icon {
        font-size: 40px;
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
        margin: 40px auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, .2);
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 10px;
        background-color: white;
        width: 600px;
    }
    .navbar-brand {
        cursor: pointer;
    }
    .login-button {
        background-image: linear-gradient(90deg, #387bf5, #6c9cf5, #8fb2f2, #c0d5fc);
        width: 300px;
        border: none;
        border-radius: 50px;
        color: white;
    }
    .error {
        font-weight: 500;
        margin: 0 50px;
    }
</style>

<body>
<nav class="navbar bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" style="font-weight: 600; font-size:25px;"><i class="bi bi-book-fill"></i> Indonesian Folklore.</a>
    </div>
</nav>

<div data-aos="fade-down" data-aos-duration="500" data-aos-easing="ease-in-sine" class="container">
    <h1>Halaman Log In</h1>
    <center><i class="bi bi-person-fill person-icon"></i></center>
    
    <?php if (isset($error)) : ?>
        <div class="alert alert-warning" role="alert">
            <center><p class="error">Username / password salah</p></center>
        </div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="mb-2">
            <b><label for="exampleFormControlInput1" class="form-label">Username</label></b>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="username" placeholder="Masukkan Username" autofocus required>
        </div>
        <div class="mb-3">
            <b><label for="inputPassword5" class="form-label">Password</label></b>
            <input type="password" id="inputPassword5" class="form-control" name="password" placeholder="Masukkan Password" aria-describedby="passwordHelpBlock" required>
        </div>
        <div class="register-link">
            <p>Tidak punya akun? <b><a href="registrasi.php">Daftar</a></b> disini</p>
        </div>
        <div class="button-form">
            <button type="submit" class="btn mt-3 login-button" name="login"><b>Masuk</b></button>
        </div>
    </form>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

</body>
</html>