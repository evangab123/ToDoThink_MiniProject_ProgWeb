<?php
    //Koneksi
    include "../dbconnect.php";
    session_start();
    if (!$_SESSION['loged_in']) {
    header('Location: login/login.php');
    }
    $id = 0;
    if($_GET){
        $id = $_GET['id'];
        $sql = "SELECT * FROM event_calender WHERE id='".$id."'";
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
        }
        else {
            echo "Data yang hendak diedit tidak ada.";
        }
        mysqli_close($db);
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Event</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <!-- <script src= "../Script/form.js" defer> </script> -->
    <link rel="stylesheet" type="text/css" href="../style/stylekalendeer34567.css" />
</head>
<body>
<header>
      <div class="container">
        <nav class="bar">
          <h1>Form Kegiatan</h1>
          <ul class="menu">
            <li class="nav-link"><a href="../index.php">Home</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <div class="formbody">
    <form action="prosesform.php" method ="POST" enctype = "multipart/form-data" onsubmit="return validasi()">
        <input type = "hidden" name="id" id="id"  value="<?php if($id != 0){echo $id;}?>"><br>
        <label>Nama: <input type = "text" name="nama" id="nama" placeholder="Nama" value="<?php if($id != 0){echo $row["nama"];}?>"></label><br>
        <label>Mulai: <input type = "date" name="mulai" id="mulai" value="<?php if($id != 0){echo $row["mulai"];}?>"></label><br>
        <label>Selesai: <input type = "date" name="selesai" id="selesai" value="<?php if($id != 0){echo $row["selesai"];}?>"></label><br>
        <label for="level">Level:</label>
          <select name="level" id="level">
            <option selected disabled>--- Pilih Level ---</option>
            <option value="sangat penting"  <?php if ($id != 0 && $row["level"] == "sangat penting") echo "selected"; ?>>Sangat Penting</option>
            <option value="penting" <?php if ($id != 0 && $row["level"] == "penting") echo "selected"; ?>>Penting</option>
            <option value="biasa" <?php if ($id != 0 && $row["level"] == "biasa") echo "selected"; ?>>Biasa</option>
          </select>
        <label>Durasi: <input type = "number" name="durasi" id="durasi" placeholder="jam" value="<?php if($id != 0){echo $row["durasi"];}?>"></label><br>
        <label>Deskripsi: <input type = "textarea" name="deskripsi" id="deskripsi" placeholder="Masukan deskripsi" value="<?php if($id != 0){echo $row["deskripsi"];}?>"></label><br>
        <label>Lokasi:  <input type = "text" name="lokasi" id="lokasi" placeholder="Masukan Lokasi" value="<?php if($id != 0){echo $row["lokasi"];}?>"></label><br>
        <label for="file">Upload Gambar: </label>
        <?php if ($id != 0 && isset($row['gambar'])): ?>
        <span><?php echo $row['gambar']; ?></span>
        <input type="file" name="upload" id="file">
        <?php else: ?>
        <input type="file" name="upload" id="file">
        <?php endif; ?><br>
        <input type = "submit" value="submit" name = "submit" >
    </form>
    </div>
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
<script>
  function validasi() {
    const nama = document.getElementById('nama').value;
    const mulai = document.getElementById('mulai').value;
    const selesai = document.getElementById('selesai').value;
    const level = document.getElementById('level').value;
    const durasi = document.getElementById('durasi').value;
    const deskripsi = document.getElementById('deskripsi').value;
    const lokasi = document.getElementById('lokasi').value;
    if (nama===''||mulai===''|| selesai===''||durasi===''||deskripsi===''||level===''){
      alert("Isi semua kolom");
      return false;
    }else if(mulai>selesai){
      alert("masukan tanggal yang valid");
      return false;
    }else if(mulai == selesai){
      alert("tanggal mulai dan selesai tidak boleh sama");
      return false;
    }else if(durasi<0){
      alert("masukan durasi yang valid dalam satuan jam");
      return false;
    }
    else{
      return true;
    }
  }
</script>
