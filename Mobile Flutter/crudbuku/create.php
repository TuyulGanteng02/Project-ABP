<?php 
    $conn=new mysqli("localhost","root","","bookshelf");
    $judul=$_POST["judul"];
    $penulis=$_POST["penulis"];
    $tahunterbit=$_POST["tahun_terbit"];
    $status=$_POST["status_dibaca"];
    $created_at = date("Y-m-d H:i:s");
    $data=mysqli_query($conn, "insert into buku set judul='$judul', penulis='$penulis', tahun_terbit='$tahunterbit', status_dibaca='$status', created_at='$created_at'");
    if ($data) {
        echo json_encode([
            'pesan'=>'Sukses'
        ]);
    } else {
        echo json_encode([
            'pesan'=>'Gagal'
        ]);
    }
?>