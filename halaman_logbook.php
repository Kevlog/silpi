<?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("location: login.php");
        exit;
    }
    require 'functions.php';
    if(isset($_GET['id'])){
        $id_author=$_GET['id'];
        // echo $_GET['id'];
    }
    $query = query("SELECT * FROM mahasiswa WHERE id_author='$id_author'");
    if (isset($_POST["cari"])) {
        $query = cari2($_POST["keyword"]);
    }
    if (isset($_POST["approve_button"])) {
      $query = approved($id_author);
      {
        echo "
            <script>
                alert('Semua data berhasil diapprove!');
                document.location.href = 'halaman_dosen.php'
            </script>
            ";
        }
    }
    $nim = $_SESSION['nim'];
    $greeting = "SELECT * FROM user WHERE nim='$nim' ";
    $result = mysqli_query($db, $greeting);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="assets/img/icons/favicon.ico"/>
        <title>Halaman Logbook- SILPI</title>
        <link rel="stylesheet" type="text/css" href="assets/css/login/util.css">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <!-- <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css"> -->
        <!-- Icon Font Awesome -->
        <script src="https://kit.fontawesome.com/746fb6b185.js" crossorigin="anonymous"></script>
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
                      <a class="nav-link" aria-current="page" href="halaman_dosen.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#cari">Cari</a>
                    </li>
                  </ul>
                  <span class="navbar-text mr-4 text-info">Selamat Datang, <?php foreach($result as $name) :?> <?= $name["nama"]; ?> <?php endforeach; ?>&nbsp;&nbsp;</span>
                  <a href="#" id="btn-logout" class="btn btn-outline-danger text-light" tabindex="-1" role="button" aria-disabled="true"><i class="bi bi-box-arrow-left"></i>&nbsp;&nbsp;Logout</a>
                </div>
              </div>
            </nav>
            <h1 class="text-center mb-4 mt-4 pb-4 pt-4 text-light" data-aos="zoom-in">Halaman Logbook SILPI</h1>
            <div class="row mt-4">
                <div class="col-md-4 col-sm-4" data-aos="fade-right">
                    <form class="d-flex" method="post">
                        <input class="form-control me-2" id="cari" type="search" name="keyword" placeholder="Cari" aria-label="Cari">
                        <button class="btn btn-outline-primary text-light bi bi-search" type="submit" name="cari"></button>
                    </form>
                </div>
                <div class="col text-end" data-aos="fade-left">
                    <form class="" method="post">
                        <input class="form-control" id="approve_button" type="hidden" name="keyword">
                        <button class="btn btn-outline-success text-light" type="submit" name="approve_button">Approve All</button>
                    </form>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table bg-secondary table-bordered table-hover text-light text-center" border="1" cellpadding="10" cellspacing="0" data-aos="zoom-in" data-aos-duration="1000">
                    <thead>
                        <tr class="table bg-dark text-light">
                            <th>Pertemuan</th>
                            <th>Tgl</th>
                            <th>Pukul</th>
                            <th>Judul Kegiatan</th>
                            <th>Sub Bahasan</th>
                            <th>Gambar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach($query as $row) :?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row["tanggal"]; ?></td>
                            <td><?= $row["pukul"]; ?></td>
                            <td><?= $row["judul"]; ?></td>
                            <td><?= $row["sub"]; ?></td>
                            <td><img src="img/<?= $row ["gambar"]; ?>" width="50" alt=""></td>
                            <td><?php if($row["is_approved"] == true) {
                                echo "Approved";
                            } else {
                                echo "Pending";
                            }; ?></td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                  </tbody>
                </table>
            </div>
            <!-- Footer -->
            <footer class="text-center text-lg-start bg-transparent text-light">
                <!-- Section: Social media -->
                <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                </section>
                <!-- Section: Social media -->
                <!-- Section: Links  -->
                <section class="">
                    <div class="container text-center text-md-start mt-5">
                        <!-- Grid row -->
                        <div class="row mt-3">
                            <!-- Grid column -->
                            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                                <!-- Content -->
                                <h6 class="text-uppercase fw-bold mb-4">JTIF</h6>
                                <img src="assets/img/jtif.png">
                                <p>Jurusan Teknik Informatika<br/>
                                Fakultas Teknik<br/>
                                Universitas Negeri Surabaya</p>
                            </div>
                            <!-- Grid column -->
                            <!-- Grid column -->
                            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                                <!-- Links -->
                                <h6 class="text-uppercase fw-bold mb-4">Link Terkait</h6>
                                <p><a href="https://www.unesa.ac.id/" target="_blank" class="text-reset">Unesa</a></p>
                                <p><a href="https://sso.unesa.ac.id/" target="_blank" class="text-reset">Single Sign On</a></p>
                                <p><a href="https://siakadu.unesa.ac.id/" target="_blank" class="text-reset">Siakadu</a></p>
                                <p><a href="https://vi-learn.unesa.ac.id/" target="_blank" class="text-reset">Vi-Learning</a></p>
                            </div>
                            <!-- Grid column -->
                            <!-- Grid column -->
                            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                                <!-- Links -->
                                <h6 class="text-uppercase fw-bold mb-4">Peta Lokasi</h6>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d31660.665577430715!2d112.70120671851672!3d-7.288171313331521!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d-7.2756194!2d112.7126838!4m5!1s0x2dd7fb77985f5b71%3A0x8226ca493dd1aea9!2sjtif%20unesa!3m2!1d-7.316258599999999!2d112.7255383!5e0!3m2!1sid!2sid!4v1639808928554!5m2!1sid!2sid" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <!-- Grid column -->
                            <!-- Grid column -->
                            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                                <!-- Links -->
                                <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                                <p><i class="fas fa-home me-3"></i> Gedung A1, Jl. Ketintang Wiyata, Ketintang, Gayungan, Surabaya City, East Java 60231</p>
                                <p><i class="fas fa-envelope me-3"></i> jtif@unesa.ac.id</p>
                                <p><i class="fas fa-phone me-3"></i>(031)8299563</p>
                            </div>
                            <!-- Grid column -->
                        </div>
                        <!-- Grid row -->
                    </div>
                </section>
                <!-- Section: Links  -->
                <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                </section>
                <!-- Copyright -->
                <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">© 2021</div>
                <!-- Copyright -->
            </footer>
            <!-- Footer -->
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