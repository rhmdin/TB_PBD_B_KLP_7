<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">        
        <title>Delmora Fashion Store Website</title>
        <link rel="stylesheet" href="Style/style_login.css">
        <script src="https://kit.fontawesome.com/5a0f2b6c16.js" crossorigin="anonymous"></script>
      </head>
      <body style=" background-image: url('Assets/background_halaman.png');">
        <div class="center" style="padding: 2%;">
          <div class="image" style="text-align: center;">
            <img alt="Logo Delmora" src="Assets/logo_delmora.png" style="width:100%;margin-bottom:-5%; ">
          </div>
          <form method="post" action="/tb_pbd_b_klp_7/BE/login.php">
            <?php 
               if(isset($_GET['msg']))
                {
                  if($_GET['msg']=="invalidacc")
                  {echo '<script>
                    alert("Akun tidak ditemukan");
                  </script>'; 
                  }
                  elseif($_GET['msg']=="invaliduser")
                  {echo '<script>
                    alert("Harap log in kembali!");
                  </script>'; 
                  }
                }
              ?>
            <div class="txt_field">
              <input <?php  if(isset($_GET['msg'])){
                      if($_GET['msg']=="invalidusn"){
                  
                      ?> autofocus  value="" <?php
                      }
                else{?>
                        value="<?php if(isset($_SESSION['Username'])=='True'){
                          echo $_SESSION['Username'];
                        }?>"<?php
                      } 
                } ?>title="Masukkan username" id="Username" name="Username" type="text" required>
                  <span></span>
              <label><i class="fas fa-user"></i> Username</label>
            </div> 
            <?php
                  if(isset($_GET['msg']))
                  {
                    
                    if($_GET['msg']=="invalidusn")
                    {?>
                      <small class="notif" style="color:red;margin-left:5%;">Username tidak ada TT</small>
                    <?php 
                    }
                  }
                  ?>
            <div class="txt_field">
              <input <?php if(isset($_GET['msg']))
                      {
                        if($_GET['msg']=="invalidpw"){
                          ?> autofocus value="" <?php
                        }
                        else{?>
                          value="<?php if(isset($_SESSION['Password'])=='True'){
                            echo $_SESSION['Password'];
                          }?>"<?php
                        } 
                      }?>  title="Masukkan password" id="Password" name="Password" type="password" required>
                    
              <span></span>
              <label><i class="fa-solid fa-lock"></i>Password</label>
            </div>
            <small class="notif" style="margin-left:5%;">*Password case sensitive</small>
              
            <?php
                  if(isset($_GET['msg']))
                  {
                    if($_GET['msg']=="invalidpw")
                    {?>
                      <small class="notif" style="color:red;margin-left:5%;">Password salah TT  <a href="" style="text-decoration: none; color:red;">Lupa password?</a></small>
                    <?php 
                    }
                  }?>
            <input type="submit" value="Login">
          </form>
        </div>
    
      </body>
</html>