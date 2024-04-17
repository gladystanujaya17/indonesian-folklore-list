<?php

session_start();

// Cek apakah user sudah login atau belum
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"]; 

if (hapus($id) > 0) {
    echo 
    "
        <script>
            alert('Data berhasil dihapus');
            document.location.href = 'index-2.php';
        </script>        
    ";
} else {
    echo 
    "
        <script>
            alert('Data gagal dihapus');
        </script>        
    ";
}
?>