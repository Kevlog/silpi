<?php
    session_start();
    require 'functions.php';


    if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];
        $result = mysqli_query($db, "SELECT nim FROM user WHERE id = $id");
        $row = mysqli_fetch_assoc($result);
        if($key === hash('sha256', $row['nim'])) {
            $_SESSION['login'] = true;
        }
    }
    if (isset($_POST["login"])) {
        $nim = $_POST["nim"];
        $password = $_POST["password"];
        $result = mysqli_query($db, "SELECT * FROM user WHERE nim = '$nim'");
        if(mysqli_num_rows($result) === 1) {
            $data = mysqli_fetch_assoc($result);
            if($data['level']=="mahasiswa") {
                $_SESSION['nim'] = $nim;
                $_SESSION['id_author'] = (int)$data['id'];
                $_SESSION['level'] = "mahasiswa";
                if(password_verify($password, $data["password"])) {
                    $_SESSION['login'] = true;
                    if(isset($_POST['remember'])) {
                        setcookie('id', $row['id'], time() + 86400);
                        setcookie('key', hash('sha256', $row['nim'], time() + 86400));
                    }
                    header("location:index.php");
                    exit;
                }
            }
            else if($data['level']=="admin") {
                $_SESSION['nim'] = $nim;
                $_SESSION['level'] = "admin";
                if(password_verify($password, $data["password"])) {
                    $_SESSION['login'] = true;
                    if(isset($_POST['remember'])) {
                        setcookie('id', $row['id'], time() + 86400);
                        setcookie('key', hash('sha256', $row['nim'], time() + 86400));
                    }
                    header("location:halaman_admin.php");
                    exit;
                }
            }
            else if($data['level']=="dosen") {
                $_SESSION['nim'] = $nim;
                $_SESSION['id_author'] = (int)$data['id'];
                $_SESSION['level'] = "dosen";
                if(password_verify($password, $data["password"])) {
                    $_SESSION['login'] = true;
                    if(isset($_POST['remember'])) {
                        setcookie('id', $row['id'], time() + 86400);
                        setcookie('key', hash('sha256', $row['nim'], time() + 86400));
                    }
                    header("location:halaman_dosen.php");
                    exit;
                }
            }else {
                header("location:login.php");
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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="assets/img/icons/favicon.ico"/>
        <title>Masuk - SILKM</title>
        <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/login/util.css">
        <link rel="stylesheet" type="text/css" href="assets/css/login/main.css">
        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    </head>
    <body>
        <div class="limiter">
            <div class="container-login100" style="background-image: url('assets/img/a10.jpg');">
                <div class="wrap-login100 p-t-30 p-b-50">
                    <span class="login100-form-title p-b-41" data-aos="zoom-in" data-aos-duration="1000">MASUK SILPI</span>
                    <form class="login100-form validate-form p-b-33 p-t-5" action="" method="post" data-aos="zoom-in" data-aos-duration="500">
                        <div class="wrap-input100 validate-input" data-validate="Enter username">
                            <input class="input100" type="text" name="nim" id="nim" placeholder="ID" required="text">
                            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input class="input100" type="password" name="password" id="password" placeholder="Kata Sandi" required="password">
                            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                        </div>

                        <div class="container-login100-form-btn m-t-32" data-aos="zoom-in" data-aos-duration="1000">
                            <button class="login100-form-btn" type="submit" name="login">
                                Login
                            </button>
                        </div>

                        <div>
                            <?php if(isset($error)) : ?>
                            <br>
                            <p class="text-center text-danger">Username / password yang Anda masukkan salah!</p>
                            <?php endif; ?>
                        </div>

                        <div class="text-center mt-4 registrasi" data-aos="zoom-in" data-aos-duration="1500">
                            <a href="registrasi.php"><i>Belum punya akun?</i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="dropDownSelect1"></div>
        <script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src="assets/vendor/animsition/js/animsition.min.js"></script>
        <script src="assets/vendor/bootstrap/js/popper.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/vendor/select2/select2.min.js"></script>
        <script src="assets/vendor/daterangepicker/moment.min.js"></script>
        <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
        <script src="assets/vendor/countdowntime/countdowntime.js"></script>
        <script src="assets/js/js/main.js"></script>
        <!-- AOS -->
        <script type="text/javascript">
            AOS.init();
        </script>
    </body>
</html>