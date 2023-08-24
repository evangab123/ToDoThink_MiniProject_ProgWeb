<?php
session_start();
if (isset($_SESSION['loged_in'])) {
    header("Location: ../index.php");
    exit; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoThink | Register</title>
    <link rel="stylesheet" href="../style/loginregis.css">
    <script>
        function validasi(){
            const username = document.getElementById("username");
            const password = document.getElementById("password");
            const passwordcon = document.getElementById("passwordconf");
            const date =document.getElementById("date");
            username.removeAttribute("class","invalid");
            password.removeAttribute("class","invalid");
            passwordcon.removeAttribute("class","invalid");
            date.removeAttribute("class","invalid");
            if(username.value!=""&&password.value!=""&&passwordcon.value!=""&&date.value==""){
                return true;
            }
            if(username.value==""&&password.value==""&&passwordcon.value==""&&date.value==""){
                username.setAttribute("class","invalid");
                password.setAttribute("class","invalid");
                passwordcon.setAttribute("class","invalid");
                date.setAttribute("class","invalid");
                return false;
            }
            if(username.value!=""){
                password.setAttribute("class","invalid");
                passwordcon.setAttribute("class","invalid");
                date.setAttribute("class","invalid");
                return false;
            }
            if(password.value!=""){
                username.setAttribute("class","invalid");
                passwordcon.setAttribute("class","invalid");
                date.setAttribute("class","invalid");
                return false;
            }
            if(passwordcon.value!=""){
                username.setAttribute("class","invalid");
                password.setAttribute("class","invalid");
                date.setAttribute("class","invalid");
                return false;
            }
            if(date.value !=""){
                username.setAttribute("class","invalid");
                password.setAttribute("class","invalid");
                passwordcon.setAttribute("class","invalid");
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
            if(password.value != passwordcon.value){
                password.setAttribute("class","invalid");
                passwordcon.setAttribute("class","invalid");
                return false;
            }
            
            if(date.value == ""){
                date.setAttribute("class","invalid");
                return false;
            }

        }
    </script>
</head>
<body>
    <main>
        <form action="prosesregis.php" method="POST" id="formregis" onsubmit="return validasi()">
            <fieldset>
                <h1>Buat Akun di <span class="judul">ToDoThink</span></h1>
                <div class="email-box">
                    <label for="username">Username: </label>
                    <input type="text" id="username" placeholder="masukan username anda" name="username">
                </div>
                <div class="password-box">
                    <label for="password">Password: </label>
                    <input type="password" id="password" placeholder="********" name="password">
                </div>
                </div>
                <div class="passwordconf-box">
                    <label for="passwordconf">Konfirmasi: </label>
                    <input type="password" id="passwordconf" placeholder="********" name="passwordconf">
                </div>
                <div class="date-box">
                    <label for="date">Tanggal lahir: </label>
                    <input type="date" id="date"  name="date">
                </div>
                <div class="btn-center">
                    <button type="submit" class="action-button" name="submit">Regis</button>
                    <button type="reset" class="action-button" name="reset">Reset</button>
                </div>
                
                <div class="regis">
                    Sudah punya akun? <a href="login.php">Login disini</a>
                </div>
            </fieldset>
        </form>
    </main>
</body>
</html>
