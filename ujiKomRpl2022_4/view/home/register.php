<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "ujikomrpl2022_4";
$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

try {
    // create PDO connection
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch (PDOException $e) {
    // show error
    die("Terjadi masalah: " . $e->getMessage());
}

if (!$link) {
    die("Koneksi dengan database gagal: " . mysqli_connect_errno() . " - " . mysqli_connect_error());
}

if (isset($_POST['register'])) {

    // filter data yang diinputkan
    $foto = filter_input(INPUT_POST, 'foto', FILTER_SANITIZE_STRING);
    $fullName = filter_input(INPUT_POST, 'nama_lengkap', FILTER_SANITIZE_STRING);
    $nik = filter_input(INPUT_POST, 'nik', FILTER_SANITIZE_NUMBER_INT);

    $pesan_error = "";

    // enskripsi nik
    if (empty($nik)) {
        $pesan_error .= "NIK Belum diisi";
    } else if (!preg_match("/^[0-9]{16}$/", $nik)) {
        $pesan_error .= "NIK harus berupa 16 digit angka";
    }

    $nik = mysqli_real_escape_string($link, $nik);
    $query = "SELECT * FROM pengguna WHERE nik='$nik'";
    $hasil_query = mysqli_query($link, $query);

    $jumlah_data = mysqli_num_rows($hasil_query);
    if ($jumlah_data >= 1) {
        $pesan_error .= "NIK yang sama sudah digunakan";
    }

    // menyiapkan query
    $sql = "INSERT INTO pengguna VALUES (:nik, :nama_lengkap, :foto)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $param = array(
            ":nik" => $nik,
            ":nama_lengkap" => $fullName,
            ":foto" => $foto
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($param);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if ($saved) header("Location: login.php");

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

    <title>Register | Peduli Diri</title>

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        main.main_deg {
            padding: 45px;
        }

        .h3_deg {
            text-align: center;
            font-family: sans-serif;
        }

        a.text_link {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <main class="main_deg ml-5 mr-5">
        <div class="card">
            <div class="card-body">
                <h3 class="h3_deg">Register for new user</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="number" class="form-control" id="nik" name="nik">
                        <small id="nik" class="form-text text-muted">Nomor NIK tidak boleh kurang atau lebih dari 16 digit.</small>
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan Nama Anda">
                    </div>
                    <div class="form-group">
                        <label for="foto">Upload Foto</label>
                        <input type="file" class="form-control-file" id="foto" name="foto">
                    </div>
                    <input type="submit" class="btn btn-primary" name="register" value="Register">
                </form>
            </div>
        </div>
    </main>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>