<?php
include "../dbconnect.php";
session_start();
if (isset($_SESSION['loged_in'])) {
    header("Location: ../index.php");
    exit; 
}

?>
<script>
    function validasi(){
            const username = document.getElementById("username");
            const password = document.getElementById("password");
            username.removeAttribute("class","invalid");
            password.removeAttribute("class","invalid");
            if(username.value == "" && password.value == ""){
                username.setAttribute("class","invalid");
                password.setAttribute("class","invalid");
                return false;
                
            }
            if(username.value==""){
                username.setAttribute("class","invalid");
                return false;
            }
            if(password.value ==""){
                password.setAttribute("class","invalid");
                return false;
            }
        }
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoThink | Log In</title>
    <link rel="stylesheet" href="../style/loginregis.css">
</head>
<body>
    
    <main>
        <form action="" method="post" id="formlogin" onsubmit="return validasi()">
            <fieldset>
                <h1>Selamat Datang di <span class="judul">ToDoThink</span></h1>
                <p id="error-message"></p>
                <div class="email-box">
                    <label for="username">Username </label>
                    <input type="text" id="username" placeholder="Masukan username anda" name="username">
                </div>
                <div class="password-box">
                    <label for="password">Password </label>
                    <input type="password" id="password" placeholder="*******" name="password" >
                </div>
                <div class="btn-center">
                    <button type="submit" class="action-button" name="submit">Sign In</button>
                    <button type="reset" class="action-button" name="reset">Reset</button>
                </div>
                <div class="regis">
                    Belum punya akun? <a href="regis.php">Regis disini</a>
                </div>
            </fieldset>
        </form>
    </main>
</body>
</html>
<?php
if (isset($_POST['submit'])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    // $passwordhash = md5($password);
    // echo($passwordhash);
    $sql = "SELECT * FROM akun WHERE username='".$username."' AND password='".$password."'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($_POST) {
        if ($row) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $row['id'];
            //$_SESSION['name'] = $row['name'];
            $_SESSION['loged_in'] = true;
            setcookie('username', $row['username'],time()*60);
            header('location: ../index.php');
        }
        else {
            echo '<script>document.getElementById("error-message").innerHTML = "Username atau password salah";</script>';
                       
        }
    }
}
?>