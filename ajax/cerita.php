<?php
usleep(100000);

require '../functions.php';

$keyword = $_GET["keyword"];
$cerita = "SELECT * FROM cerita_rakyat
                WHERE judul LIKE '%$keyword%'
                OR jenis_cerita LIKE '%$keyword%'
                OR asal_cerita LIKE '%$keyword%'";

$result = mysqli_query($con, $cerita);
?>

<style>
    .box-warning {
        padding: 60px;
        width: 800px;
        text-align: center;
    }
    h3 {
        font-weight: 600;
    }
    p {
        font-weight: 500;
    }
    .container-warning {
        display: flex;
        justify-content: center;
    }
</style>
<?php if(mysqli_num_rows($result) > 0) : ?>
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
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tbody>
        <tr>
            <td><?php echo $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
                <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah mau dihapus?');">Hapus</a>
            </td>
            <td>
                <img src="img/<?= $row["gambar"]; ?>" alt="">
            </td>
            <td><?= $row["judul"]; ?></td>
            <td><?= $row["asal_cerita"]; ?></td>
            <td><?= $row["jenis_cerita"]; ?></td>
        </tr>
    </tbody>
    <?php $i++; ?>
<?php endwhile; ?>
<?php else : ?>
    <div class="container-warning">
        <div class="alert alert-warning box-warning" role="alert">
            <center><h3>Tidak ada data</h3></center>
            <center><p>Silakan cari dengan kata kunci lain!</p></center>
        </div>
    </div>
<?php endif; ?>

</table>