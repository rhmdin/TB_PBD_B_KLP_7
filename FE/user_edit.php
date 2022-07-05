<?php

session_start(); 
include "/xampp/htdocs/TB_PBD_B_KLP_7/BE/connect.php";
$Username=$_SESSION['Username'];
$select = pg_query($connect, "SELECT * FROM tabel_daftar_user WHERE username = '$Username'");  
$akun=pg_fetch_assoc($select);
if($_SESSION['role']!="1"){
header("location:/TB_PBD_B_KLP_7/index.php?msg=invaliduser");
}
else{
  $usn=$_GET['usn'];
$select = pg_query($connect, "SELECT * FROM tabel_daftar_user JOIN tabel_role_user ON tabel_daftar_user.role_user = tabel_role_user.id_role WHERE tabel_daftar_user.username = '$usn' ");
$show = pg_fetch_assoc($select);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="/TB_PBD_B_KLP_7/Style/add.css" />

    <style>
      * {
        box-sizing: border-box;
      }

      input[type="text"],
      select,
      textarea {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 4px;
        resize: vertical;
        background: #ffebf0;
      }

      label {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        font-size: 20px;
        font-weight: 600;
        line-height: 28px;
        letter-spacing: 1px;
        text-align: left;

        padding: 12px 12px 12px 0;
        display: inline-block;
      }

      input[type="submit"] {
        background: #cc0e3c;
        box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        color: white;
        padding: 12px 20px;
        border: none;
        cursor: pointer;
        float: right;
        font-weight: 600;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        position: absolute;
        width: 20%;
        height: 46px;
        left: 65%;
        margin-right: 8%;
      }

      input[type="submit"]:hover {
        background-color: #45a049;
      }

      .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
      }

      .col-25 {
        float: left;
        width: 25%;
        margin-top: 6px;
      }

      .col-75 {
        float: left;
        width: 75%;
        margin-top: 6px;
      }

      /* Clear floats after the columns */
      .row:after {
        content: "";
        display: table;
        clear: both;
      }

      .judul {
        width: 600px;
        height: 45px;
        margin-top: 5%;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        font-style: normal;
        font-weight: 600;
        font-size: 50px;
        /* identical to box height, or 45px */
        color: #ffffff;
      }

      .logo {
        width: 171px;
        height: 50px;
        left: 34px;
        top: 15px;
      }

      /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
      @media screen and (max-width: 600px) {
        .col-25,
        .col-75 {
          width: 100%;
          margin-top: 0;
        }
      }
    </style>
    <title>Edit Data User</title>
  </head>

  <body>
    
    <center><p class="judul">Edit Data User</p></center>
    <div class="containerForm" style="padding: 8%; height: 15cm">
      <form method="POST" action="/tb_pbd_b_klp_7/BE/edit_user.php?usn=<?php echo $usn?>">
        <div class="row">
          <div class="col-25">
            <label for="fname">Username</label>
          </div>
          <div class="col-75">
            <input readonly value="<?php echo $show['username'] ?>" type="text" id="username" name="username" for="username" placeholder="Your ID" />
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Nama</label>
          </div>
          <div class="col-75">
            <input type="text" required value="<?php echo $show['nama'] ?>" id="nama" name="nama" for="nama" placeholder="Nama user" />
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">No. HP</label>
          </div>
          <div class="col-75">
            <input type="number" required min="62" id="nohp" name="nohp" for="nohp" placeholder="No hp user" />
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Role</label>
          </div>
          <div class="col-75">
          <select class="form-select" name="role" id="role" for="role" required aria-label="Default select example" >
                  <option readonly value="<?php echo $show['id_role']?>" selected><?php echo $show['nama_role']?></option>
              <?php
                  $select = pg_query($connect, "SELECT * FROM tabel_role_user");
                  $i=1;
                  while ($show1 = pg_fetch_assoc($select))
                  {
              ?> 
                  <option  value="<?php echo $show['id_role']?>"><?php echo $show1 ['nama_role']?></option>
              <?php
                  }
              ?>
              </select></div>
          
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Password</label>
          </div>
          <div class="col-75">
          <p class="notif" style="margin-top:2%;">Ubah password <a href="">di sini</a> </p>
            
          </div>
        </div>
        <br />
        <div class="row">
          <input type="submit" value="Submit" />
        </div>
      </form>
      <a  href="/TB_PBD_B_KLP_7/FE/user_daftar.php" style="text-decoration: none; hover:pointer;">
            <button OnClick="return confirm('Yakin mau kembali? Semua perubahan yang ada belum tersimpan!');">
              Batal
            </button>
          </a>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
