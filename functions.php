<?php

$con = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query) {
    global $con; 
    $result = mysqli_query($con, $query);
    $baris = []; // siapkan wadah kosong
    while ($tambah_baris = mysqli_fetch_assoc($result)) {
        $baris[] = $tambah_baris;
    }
    return $baris;
}



function tambah($tambahQuery) {
    global $con; 

    // Ambil data dari setiap element di dalam form
    $judul = htmlspecialchars($tambahQuery["judul"]);
    $asal_cerita = htmlspecialchars($tambahQuery["asal_cerita"]);
    $jenis_cerita = htmlspecialchars($tambahQuery["jenis_cerita"]);
    
    
    // Upload gambar 
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // Query INSERT
    $insertQuery = "INSERT INTO cerita_rakyat
                    VALUES
                    ('', '$judul', '$asal_cerita', 
                    '$jenis_cerita', '$gambar')";
    mysqli_query($con, $insertQuery);

    return mysqli_affected_rows($con); 
}



function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tempName = $_FILES['gambar']['tmp_name'];



    // Cek apakah yang diupload gambar/ bukan
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile); // fungsi memecah string menjadi Array



    $ekstensiGambar = strtolower(end($ekstensiGambar)); // hanya ambil ekstensi di belakangnya saja dan dipaksa supaya pakai huruf kecil
    
    if (!in_array($ekstensiGambar, $ekstensiValid)) { // kalau ekstensinya ga ada yang sesuai di $ekstensiValid
        echo "
            <script>alert('Ekstensi bukan .jpg, .jpeg, dan .png');</script>
        ";
        return false;
    }



    // Cek jika ukurannya terlalu besar (ex: maks yang diupload 2MB)
    if ($ukuranFile > 2000000) {
        echo "
            <script>alert('Ukuran terlalu besar');</script>
        ";
        return false;
    }


    // Generate nama baru (supaya ga nimpa file yang di-upload dengan nama sama)
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // Lolos pengecekan, gambar siap diupload
    move_uploaded_file($tempName, 'img/' . $namaFileBaru); // buat pindahin file

    return $namaFileBaru;
}



function hapus($id) {
    global $con;

    mysqli_query($con, "DELETE FROM cerita_rakyat WHERE id = $id");

    return mysqli_affected_rows($con);
}



function ubah($ubahQuery) { 
    global $con; 

    $id = $ubahQuery["id"];
    // Ambil data dari setiap element di dalam form
    $judul = htmlspecialchars($ubahQuery["judul"]);
    $asal_cerita = htmlspecialchars($ubahQuery["asal_cerita"]);
    $jenis_cerita = htmlspecialchars($ubahQuery["jenis_cerita"]);

    // Menyimpan gambar baru
    // 1. Ambil gambar lama
    $gambarLama = htmlspecialchars($ubahQuery["gambarLama"]);

    // 2. Cek apakah user pilih gambar baru atau tidak
    if($_FILES["gambar"]["error"] === 4) { // kalau user ga upload gambar baru, errornya nilainya 4
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    // Query UPDATE
    $updateQuery = "UPDATE cerita_rakyat
                    SET
                    judul = '$judul',
                    asal_cerita = '$asal_cerita',
                    jenis_cerita = '$jenis_cerita',
                    gambar = '$gambar'
                    WHERE id = '$id'";
    mysqli_query($con, $updateQuery);

    return mysqli_affected_rows($con); // kembalikan 
}



function cari($keyword) {
    $query = "SELECT * FROM cerita_rakyat
            WHERE judul LIKE '%$keyword%'
            OR jenis_cerita LIKE '%$keyword%'
            OR asal_cerita LIKE '%$keyword%'";
    return query($query);
}



function registrasi($data) {
    global $con;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($con, $data["password"]);
    $password2 = mysqli_real_escape_string($con, $data["password2"]);

    // Cek username sudah ada atau belum
    $user_result = mysqli_query($con, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($user_result)) { 
        echo "
        <script>alert('Username sudah ada!');</script>
        ";
        return false; 
    }

    // Cek konfirmasi password
    if ($password !== $password2) {
        echo "
            <script>alert('Konfirmasi password tidak sesuai');</script>
        ";
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    // Tambahkan user baru ke database
    mysqli_query($con, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($con);
}   
?>