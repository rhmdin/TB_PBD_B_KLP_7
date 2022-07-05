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
  $select = pg_query($connect, "SELECT * FROM tabel_transaksi JOIN tabel_pelanggan ON tabel_transaksi.id_pelanggan = tabel_pelanggan.id_pelanggan WHERE no_invoice = $noInvoice ");
  $show = pg_fetch_assoc($select);
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

    <title>Tambah Transaksi</title>
  </head>

  <body>
    <center><p class="judul" >Tambah Transaksi</p></center>
    <div class="containerForm" style="padding: 8%;">
      <form method="post" action="/tb_pbd_b_klp_7/FE/penjualan_tambah_barang.php?inv=<?php echo $noInvoice?>">
        <div class="row">
          <div class="col-25">
            <label for="fname">No Invoice</label>
          </div>
          <div class="col-75">
            <input readonly value="<?php echo $noInvoice ?>" type="text" for="noInvoice"  id="noInvoice" name="noInvoice" placeholder="Masukkan nomor invoice" />
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Pelanggan</label>
          </div>
          <div class="col-75">
            <input readonly value="<?php echo $show['nama_pelanggan']?>" type="text" for="noInvoice"  id="noInvoice" name="noInvoice" placeholder="Masukkan nomor invoice" />
          </div>
        </div> 
        <div class="row">
          <div class="col-25">
            <label for="fname">Ongkir</label>
          </div>
          <div class="col-75">
            <input readonly value="<?php echo $show['ongkir'] ?>" type="text" for="noInvoice"  id="noInvoice" name="noInvoice" placeholder="Masukkan nomor invoice" />
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="lname">Bukti Transfer</label>
          </div>
          <div class="col-75">
            <img src="/TB_PBD_B_KLP_7/Assets/Nota/<?php echo $show ['nota_pembayaran'];?>" alt="" style="width: 6cm;heigth:8cm">
            <img src="/TB_PBD_B_KLP_7/Assets/Nota/<?php echo $show ['bukti_transfer'];?>" alt="" style="width: 6cm;heigth:8cm">
          
          </div>
        </div>
        <br />
        <div class="row">
          <input type="submit" value="Tambah Barang" />
            <a href="penjualan_daftar.php"  style="text-decoration: none;">
            <button type="button" value="Submit" class="btn btn-outline-danger" style="margin-left: 980%;">
              Selesai
            </button>
          </a>
          <a href="/TB_PBD_B_KLP_7/BE/delete_transaksi.php?inv=<?php echo $noInvoice?>"  style="text-decoration: none;">
            <button type="button" value="Submit" class="btn btn-outline-danger" style="margin-left: 980%;">
              Batal
            </button>
          </a>
        </div>
      </form>
      <table id="example" class="table table-hover table-bordered" style="width:100%">
        <thead>
            <tr>
              <th>NO</th>
                <th>NAMA</th>
                <th>MODAL</th>
                <th>JUAL</th>
                <th>QTY</th>
                <th>DISKON</th>
                <th>SUB TOTAL MODAL</th>
                <th>SUB TOTAL JUAL</th>
                <th style="column-width: 1cm;"></th>
            </tr>
        </thead>
        <tbody>
          <?php
              $select = pg_query($connect, "SELECT * FROM tabel_detail_transaksi LEFT JOIN tabel_barang ON tabel_detail_transaksi.id_barang = tabel_barang.id_barang WHERE tabel_detail_transaksi.no_invoice = $noInvoice");
              $i=1;
              while ($show = pg_fetch_assoc($select))
              {
          ?>
            <tr>
                <td ><?php echo $i++; ?></td>
                <td ><?php echo $show ['nama_barang'];?></td>
                <td ><?php echo $show ['harga_beli'];?></td>
                <td ><?php echo $show ['harga_jual'];?></td>
                <td ><?php echo $show ['kuantitas_barang'];?></td>
                <td ><?php echo $show ['diskon'];?></td>
                <td ><?php echo $show ['harga_beli']*$show ['kuantitas_barang'];?></td>
                <td ><?php echo $show ['harga_jual']*$show ['kuantitas_barang'];?></td>
                <td class="btnaksi" style="padding: 0.5%;">
                    <button type="button" title="Edit data" class="btn btn-warning" style="background-color: #DDEAD2; height:8mm; width:14mm">
                      <a href="penjualan_tambah_barang_edit.php?inv=<?php echo $show ['no_invoice'] ?>&&idbrg=<?php echo $show ['id_barang']?>">
                        <i>
                          Edit
                        </i>
                      </a>
                    </button>
                    <button type="button" title="Edit data" class="btn btn-warning" style="background-color: #DDEAD2; height:8mm; width:14mm">
                      <a href="delete.php">
                      <i>
                        Hapus
                      </i>
                      </a>
                    </button>
                    <br>
                </td>
              </tr>
          <?php
              }
          ?>
        </tbody>
      </table>
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
