<?php 
    $conn=new mysqli("localhost","root","","bookshelf");
    $query=mysqli_query($conn,"select * from buku");
    $data=mysqli_fetch_all($query,MYSQLI_ASSOC);
    echo json_encode($data);
?>