<?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }
    require 'functions.php';
    $id = $_GET["id"];
    $mhs = query("SELECT * FROM user WHERE id = $id") [0];
    if(isset($_POST["submit"])) {
        if(ubahprofile($_POST) > 0) {
            echo "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'profile.php';
                </script>        
            ";
        } else {
            echo "
                <script>
                    alert('Data gagal diubah!');
                    document.location.href = 'profile.php';
                </script> 
            ";
        }
    }
    $nim = $_SESSION['nim'];
    $query = "SELECT * FROM user WHERE nim='$nim' ";
    $result = mysqli_query($db, $query);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="assets/img/icons/favicon.ico"/>
        <title>Ubah Profil - SILPI</title>
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
            <nav class="navbar sticky-top navbar-expand-lg navbar-transparent navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bold text-light">SILPI - JTIF</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border-color: black;"><span class="navbar-toggler-icon"></span></button>
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
            <div class="row justify-content-md-center">
                <div class="col-md-5">
                    <h1 class="text-center text-primary mb-4 mt-4 pt-4 pb-2" data-aos="zoom-in" data-aos-duration="1000">Edit data</h1>
                        <form class="row text-light justify-content-md-center g-3 mb-4 pb-4" action="" method = "post" enctype="multipart/form-data" data-aos="zoom-in" data-aos-duration="500">
                            <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
                            
                            <div class="col-md-12">
                                <label class="form-label" for="nama">Nama:  </label>    
                                <input class="form-control" type="text" name="nama" id="nama" required value="<?= $mhs ["nama"]; ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="nim">Nim:  </label>    
                                <input class="form-control" type="text" name="nim" id="nim" required value="<?= $mhs ["nim"]; ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="program">Program:  </label>    
                                <input class="form-control" type="text" name="program" id="program" required value="<?= $mhs ["program"]; ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="prodi">Prodi:  </label>    
                                <input class="form-control" type="text" name="prodi" id="prodi" required value="<?= $mhs ["prodi"]; ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="angkatan">Angkatan:  </label> <br>
                                <select class="form-control" type="text" name="angkatan" id="angkatan" required value="<?= $mhs ["angkatan"]; ?>">
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="perusahaan">Perusahaan:  </label> <br>
                                <input class="form-control" type="text" name="perusahaan" id="perusahaan" required value="<?= $mhs ["perusahaan"]; ?>">
                            </div>
                            <div class="col">
                                <div class="d-grid">
                                    <a href="profile.php" class="btn btn-outline-secondary text-light" tabindex="-1" role="button" aria-disabled="false">Kembali</a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-grid">
                                    <button class="btn btn-outline-warning text-light" type="submit" name="submit">Edit Data!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>    
            </div>
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