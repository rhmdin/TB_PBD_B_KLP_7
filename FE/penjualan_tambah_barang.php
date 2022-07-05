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
  $noInvoice=$_GET['inv'];
}?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="/TB_PBD_B_KLP_7/Style/add.css" />

    <title>Tambah Barang Transaksi</title>
  </head>

  <body>
    <center><p class="judul" >Tambah Barang Transaksi</p></center>
    <div class="containerForm" style="padding: 8%;">
      <form method="post" action="/tb_pbd_b_klp_7/BE/add_transaksi_barang.php?inv=<?php echo $noInvoice ?>">
        
      <div class="row">
          <div class="col-25">
            <label for="lname">Barang</label>
          </div>
          <div class="col-75">
              <select class="form-select" name="barang" id="barang" for="barang" required aria-label="Default select example" >
                  <option disabled name="barang"  value="" selected>--Pilih Barang--</option>
              <?php
                  $select = pg_query($connect, "SELECT * FROM tabel_barang");
                  $i=1;
                  while ($show = pg_fetch_assoc($select))
                  {
              ?> 
                  <option name="barang"  value="<?php echo $show['id_barang']?>"><?php echo $show['nama_barang']?></option>
              <?php
                  }
              ?>
              </select>
            </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Jumlah</label>
            </div>
          <div class="col-75">
            <input type="number" required min="1" id="jumlah" name="jumlah" placeholder="Jumlah barang" />
            <small class="notif" style="margin-left:2%">*Jumlah berupa angka minimal 1 </small>
            </div>
        </div>
        
        <div class="row">
          <div class="col-25">
            <label for="lname">Diskon</label>
          </div>
          <div class="col-75">
            <input type="number"  required min="0" id="diskon" name="diskon" placeholder="Diskon" />
            <small class="notif" style="margin-left:2%">*Diskon berupa angka minimal 0 </small>
            </div>
        </div>
        <br />
        <div class="row">
          <input type="submit" value="Tambah Barang" />
        </div><a href="/TB_PBD_B_KLP_7/FE/penjualan_tambah2.php?inv=<?php echo $noInvoice?>"  style="text-decoration: none;">
            <button type="button" value="Submit" class="btn btn-outline-danger" style="float:right; margin-right:16%">
              Batal
            </button>
          </a>
      </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src=" https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
        
      </body>
</html>
