<?php
include "../dbconnect.php";
if (isset($_POST['submit'])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    // $passwordhash = md5($password);
    $tglahir = $_POST["date"];
    $sql = "INSERT INTO akun (username, password,tanggal_lahir) values ('".$username."','".$password."','".$tglahir."')";
    if(mysqli_query($db, $sql)){
        header('location: login.php');
    } else {
        header('location: regis.php');
    }
}
?>