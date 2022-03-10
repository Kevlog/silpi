<?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }
    require 'functions.php';
    $nim = $_SESSION['nim'];
    $query = "SELECT * FROM user WHERE nim='$nim' ";
    $result = mysqli_query($db, $query);
    $id_author=$_SESSION['id_author'];
    $mahasiswa = query("SELECT * FROM file WHERE id_author = '$id_author'");
    $res = mysqli_query($db, $query);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="assets/img/icons/favicon.ico"/>
        <title>Profil Mahasiswa - SILPI</title>
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <!-- <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css"> -->
        <!-- Icon Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    </head>
    <body class="bg-custom" style="background-image: url('assets/img/unesa.jpg');">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bold text-light">SILPI - JTIF</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border-color: black;">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-uppercase fw-bold">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="profile.php">Profil</a>
                            </li>
                        </ul>
                        <span class="navbar-text mr-4 text-info">Selamat Datang, <?php foreach($result as $name) :?> <?= $name["nama"]; ?> <?php endforeach; ?>&nbsp;&nbsp;</span>
                        <a href="#" id="btn-logout" class="btn btn-outline-danger text-light" tabindex="-1" role="button" aria-disabled="true"><i class="bi bi-box-arrow-left"></i>&nbsp;&nbsp;Logout</a>
                    </div>
                </div>
            </nav>
            <h1 class="text-center mb-4 mt-4 pb-4 pt-4 text-primary" data-aos="zoom-in">File Mahasiswa</h1>
            <div class="col text-end" data-aos="fade-left">
                <a href="tambahfile.php" class="btn btn-outline-success text-light" tabindex="-1" role="button" aria-disabled="true"><i class="bi bi-person-plus"></i>&nbsp;&nbsp;Tambah Data</a>
            </div>
            <br>
            <table class="table bg-secondary table-bordered table-hover text-light" border="1" cellpadding="10" cellspacing="0" data-aos="zoom-in" data-aos-duration="1000">
                <thead>
                    <tr class="table bg-dark text-light">
                        <th colspan="2" class="text-center">Pastikan Data File Benar</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($mahasiswa as $row) :?>
                    <tr>
                        <td>Surat Permohonan Fakultas: </td>
                        <td>: <?= $row["surat"]; ?></td>
                    </tr>
                    <tr>
                        <td>Proposal Praktik Industri: </td>
                        <td>: <?= $row["proposal"]; ?></td>
                    </tr>
                    <tr>
                        <td>Nilai PI dari Industri: </td>
                        <td>: <?= $row["nilai"]; ?></td>
                    </tr>
                    <tr>
                        <td>Lembar Pengesahan PI: </td>
                        <td>: <?= $row["lembar"]; ?></td>
                    </tr>

                    <tr>
                        <td>Edit</td>
                        <td>: <a href="ubahfile.php?id=<?= $row["id"]; ?>"><button class="btn btn-outline-warning border-dark text-light"><i class="bi bi-pencil-square"></i>&nbsp;Ubah</button></a></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
            </table>
        </div>
        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        <!-- Java Script from assets -->
        <script src="assets/js/script.js"></script>
        <!-- Sweet Alert -->
        <script src="assets/js/package/dist/sweetalert2.all.min.js"></script>
        <!-- AOS -->
        <script type="text/javascript">
            AOS.init();
        </script>
    </body>
</html>