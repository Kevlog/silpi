<?php
$db = mysqli_connect("localhost", "root", "", "praktik industri");

function query($query) {
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;

}

function tambah($data) {
    global $db;
    $id_author = $_REQUEST['id_author'];
    $tanggal = htmlspecialchars($data["tanggal"]);
    $pukul = htmlspecialchars($data["pukul"]);
    $judul = htmlspecialchars($data["judul"]);
    $sub = htmlspecialchars($data["sub"]);


    $gambar = upload();
    if(!$gambar){
        return false;
    }
    



    $query = "INSERT INTO mahasiswa
                VALUES
            ('', '$tanggal', '$pukul', '$judul', '$sub', '$gambar','$id_author', '')
        ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);

}
function tambah1($data1) {
    global $db;
    $nama = htmlspecialchars($data1["nama"]);
    $nim = htmlspecialchars($data1["nim"]);
    $level = htmlspecialchars($data1["level"]);
    $password = mysqli_real_escape_string($db, $data1["password"]);

    $result = mysqli_query($db, "SELECT nim FROM user WHERE nim = '$nim'");

    $password = password_hash($password, PASSWORD_DEFAULT);




    $query = "INSERT INTO user
                VALUES
            ('', '$nim', '$nama', '', '$level', '','','' ,'','$password')
        ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);

}

function upload(){
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];


    if($error === 4){
        echo "<script>
                alert('pilih gambar terlebuh dahulu!');
                </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                    alert('yang anda upload bukan gambar!');
                    </script>";
            return false;
        
    }

    if($ukuranFile > 1000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
                </script>";
        return false;
    }
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru.= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/'. $namaFileBaru);
    return $namaFileBaru;

}

function hapus($id){
    global $db;
    mysqli_query($db, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($db);
}


function ubah($data){
    global $db;

    $id = $data["id"];
    $tanggal = htmlspecialchars($data["tanggal"]);
    $pukul = htmlspecialchars($data["pukul"]);
    $judul = htmlspecialchars($data["judul"]);
    $sub = htmlspecialchars($data["sub"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


    $query = "UPDATE mahasiswa SET 
               tanggal='$tanggal',
               pukul='$pukul',
               judul='$judul',
                sub='$sub',
                gambar='$gambar'
                WHERE id = $id
                ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function cari($keyword){
    $query = "SELECT * FROM mahasiswa
                WHERE 
                judul LIKE '%$keyword%' OR
                tanggal LIKE '%$keyword%' OR
                pukul LIKE '%$keyword%' OR
                sub LIKE '%$keyword%' OR
                gambar LIKE '%$keyword%' 
                ";

    return query($query);
}
function cari1($keyword){
    $query = "SELECT * FROM user
                WHERE 
                nama LIKE '%$keyword%' OR
                nim LIKE '%$keyword%' OR
                prodi LIKE '%$keyword%' OR
                angkatan LIKE '%$keyword%' OR
                program LIKE '%$keyword%' OR
                perusahaan LIKE '%$keyword%'OR
                level LIKE '%$keyword%'
                ";

    return query($query);
}
function cari2($keyword){
    $query = "SELECT * FROM mahasiswa
                WHERE 
                judul LIKE '%$keyword%' OR
                tanggal LIKE '%$keyword%' OR
                pukul LIKE '%$keyword%' OR
                sub LIKE '%$keyword%' OR
                gambar LIKE '%$keyword%' 
                ";

    return query($query);
}

function registrasi($data){
    global $db;
    $nim = stripslashes($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $program = htmlspecialchars($data["program"]);
    $prodi = htmlspecialchars($data["prodi"]);
    $angkatan = htmlspecialchars($data["angkatan"]);
    $perusahaan = htmlspecialchars($data["perusahaan"]);
    $password = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);
    $level = htmlspecialchars($data["level"]);

   


    $result = mysqli_query($db, "SELECT nim FROM user WHERE nim = '$nim'");



    if (mysqli_fetch_assoc($result)){
        echo "<script>
                alert('nim sudah terdaftar!')
            </script>";
        return false;
    }

    if($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
                </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($db, "INSERT INTO user VALUES('','$nim','$nama','$email','$level','$program', '$prodi','$angkatan', '$perusahaan','$password') ");

    return mysqli_affected_rows($db);

    
}

function ubahprofile($data1){
    global $db;



    $id = $data1["id"];
    $nama = htmlspecialchars($data1["nama"]);
    $nim = htmlspecialchars($data1["nim"]);
    $program = htmlspecialchars($data1["program"]);
    $prodi = htmlspecialchars($data1["prodi"]);
    $angkatan = htmlspecialchars($data1["angkatan"]);
    $perusahaan = htmlspecialchars($data1["perusahaan"]);


    $query = "UPDATE user SET 
                nama='$nama',
               nim='$nim',
               program='$program',
               prodi='$prodi',
                angkatan='$angkatan',
                perusahaan='$perusahaan'
                WHERE id = $id
                ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
function hapus1($id){
    global $db;
    mysqli_query($db, "DELETE FROM user WHERE id = $id");
    return mysqli_affected_rows($db);
}

function approved($id_author)
{
    global $db;
    $query = "UPDATE mahasiswa SET is_approved=true WHERE id_author = $id_author";
    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
function tambahfile($data) {
    global $db;
    $id_author = $_REQUEST['id_author'];
    $surat = surat();
    if(!$surat){
        return false;
    }
    $proposal = proposal();
    if(!$proposal){
        return false;
    }
    $nilai = nilai();
    if(!$nilai){
        return false;
    }
    $lembar = lembar();
    if(!$lembar){
        return false;
    }
    



    $query = "INSERT INTO file
                VALUES
            ('', '$surat', '$nilai', '$lembar', '$proposal','$id_author')
        ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);

}

function surat(){

    $namaFile = $_FILES['surat']['name'];
    $ukuranFile = $_FILES['surat']['size'];
    $error = $_FILES['surat']['error'];
    $tmpName = $_FILES['surat']['tmp_name'];


    if($error === 4){
        echo "<script>
                alert('pilih file terlebuh dahulu!');
                </script>";
        return false;
    }

    $ekstensiGambarValid = ['pdf'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                    alert('yang anda upload bukan pdf!');
                    </script>";
            return false;
        
    }

    if($ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran pdf terlalu besar!');
                </script>";
        return false;
    }

    move_uploaded_file($tmpName, 'pdf/'. $namaFile);
    return $namaFile;

}
function proposal(){

    $namaFile = $_FILES['proposal']['name'];
    $ukuranFile = $_FILES['proposal']['size'];
    $error = $_FILES['proposal']['error'];
    $tmpName = $_FILES['proposal']['tmp_name'];


    if($error === 4){
        echo "<script>
                alert('pilih file terlebuh dahulu!');
                </script>";
        return false;
    }

    $ekstensiGambarValid = ['pdf'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                    alert('yang anda upload bukan pdf!');
                    </script>";
            return false;
        
    }

    if($ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran pdf terlalu besar!');
                </script>";
        return false;
    }

    move_uploaded_file($tmpName, 'pdf/'. $namaFile);
    return $namaFile;

}
function nilai(){

    $namaFile = $_FILES['nilai']['name'];
    $ukuranFile = $_FILES['nilai']['size'];
    $error = $_FILES['nilai']['error'];
    $tmpName = $_FILES['nilai']['tmp_name'];


    if($error === 4){
        echo "<script>
                alert('pilih file terlebuh dahulu!');
                </script>";
        return false;
    }

    $ekstensiGambarValid = ['pdf'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                    alert('yang anda upload bukan pdf!');
                    </script>";
            return false;
        
    }

    if($ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran pdf terlalu besar!');
                </script>";
        return false;
    }

    move_uploaded_file($tmpName, 'pdf/'. $namaFile);
    return $namaFile;

}
function lembar(){

    $namaFile = $_FILES['lembar']['name'];
    $ukuranFile = $_FILES['lembar']['size'];
    $error = $_FILES['lembar']['error'];
    $tmpName = $_FILES['lembar']['tmp_name'];


    if($error === 4){
        echo "<script>
                alert('pilih file terlebuh dahulu!');
                </script>";
        return false;
    }

    $ekstensiGambarValid = ['pdf'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                    alert('yang anda upload bukan pdf!');
                    </script>";
            return false;
        
    }

    if($ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran pdf terlalu besar!');
                </script>";
        return false;
    }

    move_uploaded_file($tmpName, 'pdf/'. $namaFile);
    return $namaFile;

}
function ubahfile($data){
    global $db;

    $id = $data["id"];
    $suratLama = htmlspecialchars($data["suratLama"]);
    $nilaiLama = htmlspecialchars($data["nilaiLama"]);
    $lembarLama = htmlspecialchars($data["lembarLama"]);
    $proposalLama = htmlspecialchars($data["proposalLama"]);

    if($_FILES['surat']['error'] === 4) {
        $surat = $suratLama;
    } else {
        $surat = surat();
    }
    if($_FILES['nilai']['error'] === 4) {
        $nilai = $nilaiLama;
    } else {
        $nilai = nilai();
    }
    if($_FILES['lembar']['error'] === 4) {
        $lembar = $lembarLama;
    } else {
        $lembar = lembar();
    }
    if($_FILES['proposal']['error'] === 4) {
        $proposal = $proposalLama;
    } else {
        $proposal = proposal();
    }


    $query = "UPDATE file SET 
                surat='$surat',
                nilai='$nilai',
                lembar='$lembar',
                proposal='$proposal'
                WHERE id = $id
                ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

?>