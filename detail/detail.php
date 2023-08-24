<?php
include ("../dbconnect.php");
session_start();
if (!$_SESSION['loged_in']) {
  header('Location: login/login.php');
}
if($_GET){
  $idevent = $_GET['id'];
  $tanggal = $_GET['tanggal'];
  $tanggalsl = $_GET['tanggalselesai'];
  //$nama = $_GET['nama'];
  $id = $_SESSION['id'];
  $sql = "SELECT * FROM event_calender where mulai = '".$tanggal."'AND id_akun='".$id."'AND selesai = '".$tanggalsl."'";
  $result = mysqli_query($db,$sql);
  $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DETAIL KEGIATAN</title>
    <link rel="stylesheet" type="text/css" href="../style/stylekalendeer34567.css"/>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>
  <body>
    <header>
      <div class="container">
        <nav class="bar">
          <h1>Detail Kegiatan</h1>
          <ul class="menu">
            <li class="nav-link"><a href="../index.php">Home</a></li>
          </ul>
        </nav>
      </div>
      <script src = "../Script/detailjs.js"></script>
    </header>
    <aside class="informasi">
      <div>
        <p class="judul">Tombol</p>
        <button class="tomboldetail" onclick="updateevent('<?php echo $idevent?>','<?php echo $tanggal ?>','<?php echo $tanggalsl?>')">UPDATE</button>
        <button class="tomboldetail" onclick="deleteevent('<?php echo $idevent?>','<?php echo $tanggal ?>','<?php echo $tanggalsl?>')">DELETE</button>
      </div>
    </aside>
    <center>
      <div>
        <table class="tabeldetail">
          <tr>
            <td class="infoo">Nama Kegiatan :</td>
            <td class="Detail"><?php if($row != null) {echo $row["nama"];}else{header('location: ../index.php');}?></td>
          </tr>
          <tr>
            <td class="infoo">Tanggal Mulai Kegiatan :</td>
            <td class="Detail"><?php  if($row != null)  echo $row["mulai"]?></td>
          </tr>
          <tr>
            <td class="infoo">Tanggal Selesai Kegiatan :</td>
            <td class="Detail"><?php if($row != null) echo $row["selesai"]?></td>
          </tr>
          <tr>
            <td class="infoo">Level Penting :</td>
            <td class="Detail"><?php if($row != null) echo $row["level"]?></td>
          </tr>
          <tr>
            <td class="infoo">Durasi Kegiatan :</td>
            <td class="Detail"><?php if($row != null) echo $row["durasi"]?></td>
          </tr>
          <tr>
            <td class="infoo">Lokasi :</td>
            <td class="Detail"><?php if($row != null) echo $row["lokasi"]?></td>
          </tr>
          <tr>
            <td class="infoo">Deskripsi :</td>
            <td class="Detail"><?php if($row != null) echo $row["deskripsi"]?></td>
          </tr>
          <tr>
            <td class="gambar" colspan="2">
              <img width= 500px height= 200px src="<?php echo $row["gambar"]?>" alt="Tidak ada gambar" />
            </td>
          </tr>
        </table>
      </div>
    </center>

    <footer id="footerdetail">
      <div class="footerisi">
        <h1>ToDoThink</h1>
        <ul class="socials">
          <li>
            <a href="#"><i class="fa fa-facebook"></i></a>
          </li>
          <li>
            <a href="#"><i class="fa fa-twitter"></i></a>
          </li>
          <li>
            <a href="#"><i class="fa fa-google-plus"></i></a>
          </li>
          <li>
            <a href="#"><i class="fa fa-youtube"></i></a>
          </li>
          <li>
            <a href="#"><i class="fa fa-linkedin-square"></i></a>
          </li>
        </ul>
      </div>
      <div class="bawah">
        <p>Designed by <span>Kelompok 2</span></p>
      </div>
    </footer>
  </body>
</html>
