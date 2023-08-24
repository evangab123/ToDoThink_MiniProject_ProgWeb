<?php
// Menghubungkan ke server database
include("dbconnect.php");
// Menjalankan kueri untuk mengambil data dari database
$sql = "SELECT * FROM event_calender";
$result = mysqli_query($db, $sql);
// Membuat array untuk menyimpan data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}
// Menutup koneksi
mysqli_close($db);
// Mengirim data sebagai respons

echo json_encode($data);
?>