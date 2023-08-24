<?php
  session_start();
  $username = $_SESSION['username'];
  
  if (!$_SESSION['loged_in']) {
    header('Location: login/login.php');
  }
  if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ./login/login.php');
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ToDoThink | Kalender</title>
    <link rel="stylesheet" type="text/css" href="./style/stylekalendeer34567.css" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src= "./Script/calender.js" defer> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <header id="head">
      <div class="container">
        <nav class="bar">
          <h1>ToDoThink</h1>
          <ul class="menu">
            <li class="nav-link"><span id = "prev"><<</span></li>
            <li class="nav-link"><span id = "today">Hari ini</span></li>
            <li class="nav-link"><span id = "next">>></span></li>
          </ul>
        </nav>
      </div>
    </header>
    <aside class="informasi">
      <div>
        <p class="judul">Informasi</p>
        <p>Selamat datang, <i><?php echo $_SESSION["username"]?></i></p>
        <p>
          <span id="merah">Merah</span>= Sangat Penting<br />
          <span id="biru">Biru</span> = Penting <br>
          <span id="hijau">Hijau</span>= Biasa<br>
          <a href ="./form/form.php"> <button class="tombol"><div class="fa fa-plus"></div></button></a>
          <form method="post" id="formlogout"><input class="logoutbtn" type="submit" value="Logout" name="logout"></form>
        </p>
      </div>
    </aside>
    
    <table id="homee">
      <td class="cal">
      <div class="kalender">
        <div class="bulan">
        </div>
        <table id="tabelkalender">
          <thead>
            <tr>
              <th class="Hariheader">Senin</th>
              <th class="Hariheader">Selasa</th>
              <th class="Hariheader">Rabu</th>
              <th class="Hariheader">Kamis</th>
              <th class="Hariheader">Jumat</th>
              <th class="Hariheader">Sabtu</th>
              <th class="Hariheader">Minggu</th>
              </tr>
          </thead>
        </table>
      </div>
      </td> 
      <td class="informasievent">
        <div class="events">
        </div>
      </td>
    </table>
        
    <footer>
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
