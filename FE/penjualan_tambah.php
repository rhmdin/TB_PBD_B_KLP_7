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
  $select = pg_query($connect, "SELECT max(no_invoice) as max FROM tabel_transaksi");  
  $max=pg_fetch_assoc($select);
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

    <title>Tambah Transaksi</title>
  </head>

  <body>
    <center><p class="judul" >Tambah Transaksi</p></center>
    <div class="containerForm" style="padding: 8%;">
      <form method="post" action="/tb_pbd_b_klp_7/BE/add_transaksi.php" enctype="multipart/form-data">
        <div class="row">
          <div class="col-25">
            <label for="fname">No Invoice</label>
          </div>
          <div class="col-75">
            <input type="number" value="<?php echo $max['max'] + 1?>" minlength="1" required for="noInvoice"  id="noInvoice" name="noInvoice" placeholder="Masukkan nomor invoice" />
          <small class="notif" style="margin-left:2%">*No Invoice hanya berupa angka minimal 1 digit</small>
            </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Pelanggan</label>
          </div>
          <div class="col-75">
              <select  required class="form-select" name="pelanggan" id="pelanggan" for="pelanggan" required aria-label="Default select example" >
                  <option required disabled selected>--Pilih Pelanggan--</option>
              <?php
                  $select = pg_query($connect, "SELECT * FROM tabel_pelanggan ORDER BY nama_pelanggan ASC");
                  $i=1;
                  while ($show = pg_fetch_assoc($select))
                  {
              ?> 
                  <option required value="<?php echo $show['id_pelanggan']?>"><?php echo $show['nama_pelanggan']?></option>
              <?php
                  }
              ?>
              </select>
              <small class="notif" style="margin-left:2%">*Tidak ada opsi pelanggan? tambah  <a onclick="<?php $_SESSION ['page1'] = 'penjualan' ?>" href="/TB_PBD_B_KLP_7/FE/pelanggan_tambah.php">di sini</a> </small>
            </div>
        </div><div class="row">
          <div class="col-25">
            <label for="lname">Platform Pembayaran</label>
          </div>
          <div class="col-75">
              <select  required class="form-select" name="payment" id="payment" for="payment" required aria-label="Default select example" >
                  <option required disabled selected>--Pilih Payment Method--</option>
              <?php
                  $select = pg_query($connect, "SELECT * FROM tabel_platform_pembayaran ORDER BY platform ASC");
                  $i=1;
                  while ($show = pg_fetch_assoc($select))
                  {
              ?> 
                  <option required value="<?php echo $show['id']?>"><?php echo $show['platform']?></option>
              <?php
                  }
              ?>
              </select>
              <small class="notif" style="margin-left:2%">*Tidak ada opsi payment method? tambah <a onclick="<?php $_SESSION['page'] = 'hmmm' ?>" href="/TB_PBD_B_KLP_7/FE/payment_tambah.php">di sini</a> </small>
            </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Ongkir</label>
          </div>
          <div class="col-75">
            <input type="text" id="ongkir" required name="ongkir" placeholder="Ongkir barang" />
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Bukti Transfer</label>
          </div>
          <div class="col-75">
            <input required type="file" class="form-control" name="bukti" id="bukti" for="bukti">
            <small class="notif" style="margin-left:2%">*Ukuran file maksimal 50 MB dan berjenis jpg, jpeg, atau png </small>
            </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Nota</label>
            </div>
          <div class="col-75">
            <input required type="file" class="form-control" name="nota" id="nota" for="nota">
            <small class="notif" style="margin-left:2%">*Ukuran file maksimal 50 MB dan berjenis jpg, jpeg, atau png </small>
            </div>
        </div>
        <br />
        <div class="row">
          <input type="submit" value="Tambah Barang" />
          <a href="penjualan_daftar.php"  style="text-decoration: none;">
            <button OnClick="return confirm('Yakin mau kembali? Semua perubahan yang ada akan hilang!');" type="button" value="Submit" class="btn btn-outline-danger" style="margin-left: 860%;">
              Kembali
            </button>
          </a>
        </div>
      </form>
      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src=" https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
        
        <script language="JavaScript" type="text/javascript">
          function HandleBrowseClick()
            {
              var fileinput = document.getElementById("browse");
              fileinput.click();
            }
          function Handlechange()
            {
              var fileinput = document.getElementById("browse");
              var textinput = document.getElementById("filename");
              textinput.value = fileinput.value;
            }
        </script>
      </body>
</html>
