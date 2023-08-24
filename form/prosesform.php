<?php
    include ("../dbconnect.php");
    session_start();
    $id_akun = $_SESSION["id"];
    $id_event = $_POST["id"];
    $sql = "SELECT * FROM event_calender WHERE id='".$id_event."'";
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
        }
        else {
            echo "Data yang hendak diedit tidak ada.";
        }
    
    if($_POST){
        if($id_event == null){
            //insert into
            $nama = $_POST['nama'];
            $mulai = $_POST['mulai'];
            $selesai = $_POST['selesai'];
            $level = $_POST["level"];
            $durasi = $_POST['durasi'];
            $deskripsi = $_POST['deskripsi'];
            $lokasi = $_POST['lokasi'];
            if(!empty($_FILES['upload']['name'])){        
                $filenama = $_FILES['upload']['name'];
                $filetmp = $_FILES['upload']['tmp_name'];
                $filesize =$_FILES['upload']['size'];
                $uploadfile = "../images/".uniqid().$filenama;
                $tipefile = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));
                if ($tipefile != "jpg" && $tipefile != "png" && $tipefile != "jpeg") {
                    // header("location: form.php?id=".$id_event);
                    header('location: form.php');
                    
                    
                }else{
                    if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadfile)){
                        $sql = "INSERT INTO event_calender 
                        (nama, mulai,selesai,durasi,level,deskripsi,lokasi,gambar,id_akun) values 
                        ('".$nama."','".$mulai."','".$selesai."','".$durasi."','".$level."','".$deskripsi."','".$lokasi."','".$uploadfile."','".$_SESSION['id']."')";
                        if(mysqli_query($db, $sql)){
                            header('location: ../index.php');
                        };
                    }else{
                        echo "gagal menambah event";
                        header('location: form.php');
                    }
                }
            }else{
                $sql = "INSERT INTO event_calender 
                        (nama, mulai,selesai,durasi,level,deskripsi,lokasi,gambar,id_akun) values 
                        ('".$nama."','".$mulai."','".$selesai."','".$durasi."','".$level."','".$deskripsi."','".$lokasi."','".null."','".$_SESSION['id']."')";
                if(mysqli_query($db, $sql)){
                    header('location: ../index.php');
                }
                else{
                    echo "gagal menambah event";
                    // header('location: form.php?id='.$id_event);
                    if($id != 0){echo ("form.php?id=".$id_event);} else{
                        echo ("form.php");
                    }
                }
            }
        }else if($_POST["id"] != null){
            //update
            $nama = $_POST['nama'];
            $mulai = $_POST['mulai'];
            $selesai = $_POST['selesai'];
            $level = $_POST["level"];
            $durasi = $_POST['durasi'];
            $deskripsi = $_POST['deskripsi'];
            $lokasi = $_POST['lokasi'];
            $filenama = $_FILES['upload']['name'];
            if(!empty($_FILES['upload']['name'])){
                if (file_exists($row["gambar"])) {
                    unlink($row["gambar"]);
                }
                $uploadfile = "../images/".uniqid().$filenama;
                $tipefile = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));
                $sql = "UPDATE event_calender set
                    nama= \"$nama\",
                    mulai= \"$mulai\",
                    selesai= \"$selesai\",
                    durasi= \"$durasi\",
                    level= \"$level\",
                    deskripsi= \"$deskripsi\",
                    lokasi= \"$lokasi\",
                    gambar= \"$uploadfile\",
                    id_akun= \"$id_akun\"
                    where id= \"$id_event\"
                    ";
                if ($tipefile != "jpg" && $tipefile != "png" && $tipefile != "jpeg") {                    
                    header("location: form.php?id=".$id_event);
                   
                }else{
                    if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadfile)){
                        if(mysqli_query($db, $sql)){
                            header('location: ../index.php');
                        };
                    }else{
                        echo "gagal update event";
                        // header("location: form.php?id=".$id_event);
                        echo ("form.php?id=".$id_event);
                    }
            }
            }else{
                $sql = "UPDATE event_calender set
                    nama= \"$nama\",
                    mulai= \"$mulai\",
                    selesai= \"$selesai\",
                    durasi= \"$durasi\",
                    level= \"$level\",
                    deskripsi= \"$deskripsi\",
                    lokasi= \"$lokasi\",
                    id_akun= \"$id_akun\"
                    where id= \"$id_event\"";
                if(mysqli_query($db, $sql)){
                    header('location: ../index.php');
                }
                else{
                    echo "gagal update event";
                    header("location: form.php?id=".$id_event);
                    
                }

            }
            
        }
    }
    
?>