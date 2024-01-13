<?php 
    $conn=new mysqli("localhost","root","","bookshelf");
    $id=$_POST["id"];
    $judul=$_POST["judul"];
    $penulis=$_POST["penulis"];
    $tahunterbit=$_POST["tahun_terbit"];
    $status=$_POST["status_dibaca"];
    $data=mysqli_query($conn, "update buku set id='$id', judul='$judul', penulis='$penulis', tahun_terbit='$tahunterbit', status_dibaca='$status' where id='$id' ");
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