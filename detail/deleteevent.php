<?php
include ("../dbconnect.php");
session_start();
$sqldel = "DELETE FROM event_calender WHERE id='".$_GET["id"]."'";
$sqlselect ="SELECT * FROM event_calender where id='".$_GET["id"]."'"; 
$result = mysqli_query($db, $sqlselect);
$row=mysqli_fetch_assoc($result);
if (file_exists($row["gambar"])) {
    unlink($row["gambar"]);
}

if(mysqli_query($db,$sqldel)){
    header("Location: ../index.php");
}else{
    echo "Gagal Mengapus data data.";
}
?>
