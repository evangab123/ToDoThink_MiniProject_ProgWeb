<?php
session_start();
$data = array(
  'id' => $_SESSION['id']
);

// Mengirim data sebagai respons JSON
header('Content-Type: application/json');
echo json_encode($data);

?>