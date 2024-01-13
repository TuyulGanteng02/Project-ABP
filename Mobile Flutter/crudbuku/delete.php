<?php 
    $conn=new mysqli("localhost","root","","bookshelf");
    $id=$_POST["id"];
    $data=mysqli_query($conn, "delete from buku where id='$id'");
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