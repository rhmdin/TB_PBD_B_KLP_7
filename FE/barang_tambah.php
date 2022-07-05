<?php
session_start(); 
include "/xampp/htdocs/TB_PBD_B_KLP_7/BE/connect.php";
$Username=$_SESSION['Username'];
  $select = pg_query($connect, "SELECT * FROM tabel_daftar_user WHERE username = '$Username'");  
  $akun=pg_fetch_assoc($select);
  if($_SESSION['role']!="3"){
  header("location:/TB_PBD_B_KLP_7/index.php?msg=invaliduser");
}
else{
$select = pg_query($connect, "SELECT MAX(id_barang) as max FROM tabel_barang");
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
    <link rel="stylesheet" href="/TB_PBD_B_KLP_7//Style/add.css" />

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
    <title>Tambah Barang</title>
  </head>

  <body>
    <center><p class="judul">Tambah Barang</p></center>
    <div class="containerForm" style="padding: 8%; height: 15cm">
      <form method="post" action="/tb_pbd_b_klp_7/BE/add_barang.php">
        <div class="row">
          <div class="col-25">
            <label for="fname">ID</label>
          </div>
          <div class="col-75">
            <input minlength="4" min="1"  value="<?php echo $show['max']+1 ?>" required type="number" id="id_barang" name="id_barang" for="id_barang" placeholder="ID barang" />
            <small class="notif" style="margin-left:2%">*ID barang hanya berupa angka minimal 1 digit</small>
            </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Barang</label>
          </div>
          <div class="col-75">
            <input minlength="4" required type="text" id="nama_barang" name="nama_barang" for="nama_barang" placeholder="Nama barang" />
            <small class="notif" style="margin-left:2%">*Nama barang minimal terdiri atas 4 karakter </small>
            </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Harga Beli</label>
          </div>
          <div class="col-75">
            <input min="500" required type="number" id="harga_beli" name="harga_beli" for="harga_beli" placeholder="Harga satuan" />
            <small class="notif" style="margin-left:2%">*Harga barang minimal Rp500 </small>
            </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Harga Jual</label>
          </div>
          <div class="col-75">
            <input  min="500" required type="number" id="harga_jual" name="harga_jual" for="harga_jual" placeholder="Harga satuan" />
            <small class="notif" style="margin-left:2%; margin-bottom:2cm">*Harga jual minimal Rp500 </small>
            </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Supplier</label>
          </div>
          <div class="col-75">
          <select  required class="form-select" name="supplier" id="supplier" for="supplier" required aria-label="Default select example" >
                  <option required disabled selected>--Pilih supplier--</option>
              <?php
                  $select = pg_query($connect, "SELECT * FROM tabel_supplier");
                  $i=1;
                  while ($show = pg_fetch_assoc($select))
                  {
              ?> 
                  <option required value="<?php echo $show['id_supplier']?>"><?php echo $show['nama_supplier']?></option>
              <?php
                  }
              ?>
              </select>
              <small class="notif" style="margin-left:2%; margin-bottom:2cm">*Tidak ada supplier yang dicari? Tambah <a href="/TB_PBD_B_KLP_7/FE/supplier_tambah.php" onclick="<?php $_SESSION['page'] = 'add_brg'?>" >di sini</a> </small>
            </div>
        </div>
        <br />
        <div class="row">
          <input required type="submit" value="Tambah" />
        </div>
      </form>
      
      <a  href="/TB_PBD_B_KLP_7/FE/barang_daftar.php" style="text-decoration: none; hover:pointer;">
            <button OnClick="return confirm('Yakin mau kembali? Semua perubahan yang ada akan hilang!');">
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
