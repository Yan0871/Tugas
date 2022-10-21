<?php
// periksa apakah user sudah login, cek kehadiran session nik
// jika tidak ada, redirect ke login.php
session_start();
if (!isset($_SESSION["nik"])) {
    header("Location: login.php");
}

// buka koneksi ke mysql
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "ujikomrpl2022_4";
$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// periksa koneksi, tampilkan pesan kesalahan jika gagal
if (!$link) {
    die("Koneksi dengan database gagal : " . mysqli_connect_errno() . " - " . mysqli_connect_error());
}

// ambil pesan jika ada
if (isset($_GET["pesan"])) {
    $pesan = $_GET["pesan"];
}

// cek apakah form telah di submit
// berasal dari form pencarian, siapkan query
if (isset($_GET["submit"])) {

    // ambil nilai tanggal
    $lokasi = htmlentities(strip_tags(trim($_GET["lokasi"])));

    // filter untuk $lokasi untuk mencegah sql injection
    $lokasi = mysqli_real_escape_string($link, $lokasi);

    // buat query pencarian
    $query = "SELECT * FROM data_perjalanan WHERE lokasi LIKE '%$lokasi%'";
    $query .= "ORDER BY lokasi ASC";

    // buat pesan
    $pesan = "Hasil pencarian untuk lokasi <b>'$lokasi'</b>";
} else {
    // bukan dari form pencarian
    // siapkan query untuk menampilkan seluruh data dari tabel data_perjalanan
    $query = "SELECT * FORM data_perjalanan";
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Peduli Diri</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        ul.nav li.nav-item a.text_deg:hover {
            color: #000 !important;
        }
    </style>
</head>
<body>
<header class="container-fluid mt-5 ml-5 pt-3 pl-5">
    <div class="row">
        <div class="col-2">
            <img src="../asset/image/dummy-200x200.png" alt="..." class="img-thumbnail">
            <h4 style="text-align: center;">Nama Pengguna</h4>
        </div>
        <div class="col-10">
            <h1>Peduli Diri</h1>
            <p>Catatan Perjalanan</p>
            <ul class="nav">
                <li class="nav-item ml-0 pl-0">
                    <a style="display: inline;" class="nav-link text_deg" href="home.php">Home</a>
                </li>
                <li class="nav-item ml-0 pl-0">
                    <span>|</span> <a style="display: inline;" class="nav-link text_deg" href="catatan_perjalanan.php">Catatan Perjalanan </a>
                </li>
                <li class="nav-item ml-0 pl-0">
                    <span>|</span> <a style="display: inline;" class="nav-link text_deg" href="isi_data.php">Isi Data</a>
                </li>
                <li class="nav-item ml-0 pl-0">
                    <span>|</span> <a style="display: inline;" class="nav-link text_deg" href="pengaturan.php">Edit Profile</a>
                </li>
                <li class="nav-item ml-0 pl-0">
                    <span>|</span> <a style="display: inline;" class="nav-link text_deg" href="logout.php">Log out</a>
                </li>
            </ul>
        </div>
    </div>
</header>

<article class="container-fluid pb-5 mb-5">
    <main class="mt-5 pt-3">
        <div class="border border-dark" style="margin-top: 25px; margin-right: 15%; margin-left: 15%;">
            <div style="margin: 10px;">
                <p style="display: inline-block;">Urutkan Berdasarkan &nbsp;</p>
                <div class="dropdown" style="display: inline">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tanggal
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Tanggal</a>
                        <a class="dropdown-item" href="#">Waktu</a>
                        <a class="dropdown-item" href="#">Lokasi</a>
                        <a class="dropdown-item" href="#">Suhu</a>
                    </div>
                </div>
                <button class="btn btn-success">Urutkan</button>
            </div>
        </div>
        <div class="border border-dark" style="margin-top: 25px; margin-right: 15%; margin-left: 15%;">
            <?php
            // tampilkan pesan jika ada
            if (isset($pesan)) {
                echo "<div class='pesan'>$pesan</div>";
            }
            ?>
            <table class="table table-bordered" style="margin-left: 49px; margin-top: 30px; margin-right: 27px; width: 90%;">
                <thead class="table-secondary">
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Lokasi</th>
                        <th>Suhu</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   // jalankan query
                   $result = mysqli_query($link, $query);

                   if (!$result) {
                       die("Query Error: " . mysqli_errno($link) . " - " . mysqli_error($link));
                   }

                   // buat perulangan untuk element tabel dari data perjalanan
                   while ($data = mysqli_fetch_array($result)) {
                       echo "<tr>";
                       echo "<td>$data[tanggal]</td>";
                       echo "<td>$data[waktu]</td>";
                       echo "<td>$data[lokasi]</td>";
                       echo "<td>$data[suhu_tubuh]</td>";
                       echo "</tr>";
                   }

                   // bebaskan memory
                   mysqli_free_result($result);

                   // tutup koneksi dengan database mysqli
                   mysqli_close($link);

                   ?>
                </tbody>
            </table>
            <br>
            <a href="isi_data.php" class="btn btn-primary" style="margin-left: 76%; margin-top: 15px; margin-bottom: 25px;">Isi Catatan Perjalanan</a>
        </div>
    </main>
</article>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>