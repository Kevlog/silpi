<?php
    require 'functions.php';
    if(isset($_POST["register"])) {
        if(registrasi($_POST) > 0) {
            echo "<script>
                    alert('berhasil ditambahkan!');
                    document.location.href = 'login.php'
            </script>";
        } else {
            echo mysqli_error($db);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="assets/img/icons/favicon.ico"/>
        <title>Halaman Registrasi</title>
        <link rel="stylesheet" type="text/css" href="assets/css/login/main.css">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    </head>
    <body class="container-login100" style="background-image: url('assets/img/a10.jpg');">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <h1 class="text-center mb-4 mt-4 pt-4 pb-2 text-white" data-aos="zoom-in" data-aos-duration="1000">Halaman Registrasi</h1>
                    <form class="row justify-content-md-center g-3 mb-4 pb-4 text-white" action="" method = "post" enctype="multipart/form-data" data-aos="zoom-in" data-aos-duration="500">
                        <div class="col-md-12">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <input class="form-control" type="text" name="nama" id="nama">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="nim">NIM</label>
                            <input class="form-control" type="text" name="nim" id="nim">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="email">Alamat Email</label>
                            <input class="form-control" type="text" name="email" id="email">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="program">Program Kampus Merdeka</label>
                            <input class="form-control" type="text" name="program" id="program">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="perusahaan">Perusahaan</label>
                            <input class="form-control" type="text" name="perusahaan" id="perusahaan">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="prodi">Program Studi</label>
                            <input class="form-control" type="text" name="prodi" id="prodi">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="angkatan">Angkatan</label>
                            <select class="form-control" name="angkatan" id="angkatan">
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                            </select>        
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="level">Level</label>
                            <select class="form-control" name="level" id="level">
                                <option value="admin">Admin</option>
                                <option value="dosen">Dosen</option>
                                <option value="mahasiswa">Mahasiswa</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="password2">Konfirmasi Password</label>
                            <input class="form-control" type="password" name="password2" id="password2">
                        </div>
                        <div class="col">
                            <div class="d-grid">
                                <a href="login.php" class="btn btn-outline-secondary text-light" tabindex="-1" role="button" aria-disabled="false">Kembali</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-grid">
                                <button class="btn btn-outline-success text-light tambah-data" type="submit" name="register">Daftar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <!-- AOS -->
    <script type="text/javascript">
        AOS.init();
    </script>
</html>