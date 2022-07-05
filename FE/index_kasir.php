<?php
  session_start(); 
  include "/xampp/htdocs/TB_PBD_B_KLP_7/BE/connect.php";
  $Username=$_SESSION['Username'];
    $select = pg_query($connect, "SELECT * FROM tabel_daftar_user JOIN tabel_role_user ON tabel_daftar_user.role_user = tabel_role_user.id_role WHERE username = '$Username'");  
    $akun=pg_fetch_assoc($select);
    if($_SESSION['role']!="3"){
		header("location:/TB_PBD_B_KLP_7/index.php?msg=invaliduser");
	}
    else{
        $select = pg_query($connect, "SELECT * FROM tabel_pelanggan ORDER BY id_pelanggan ASC");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Kasir</title>
    <link rel="stylesheet" href="/TB_PBD_B_KLP_7/Style/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>     
    <style> 
    </style> 
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position:fixed; width:100%">
        <table class="center" style="margin: auto;">
            <thead>
                <tr>
                    <td>
                        <h1 class="" style="">Selamat Datang, </h1>
                    </td>
                    <td><h1 style="color: #CC0E3C ;"><?php echo $akun ['nama_role'] ?></h1></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;" colspan="2">
                        <h2>Website Delmora Fashion Store</h2>
                    </td>
                </tr>
            </tbody>
        </table>  
    </nav>
      <br>
      <div class="center" style="margin-top: 49mm; margin-left: 50mm; margin-right: mm;">
        <table style="">
            <thead >
                <tr >
                  <td >
                      <a href="/TB_PBD_B_KLP_7/FE/barang_daftar.php" style="text-decoration: none;">
                      <div class="menu" style="margin-right:40mm; margin-bottom: 10mm;text-align:center;">
                      <img src="/TB_PBD_B_KLP_7/Assets/akun.svg" alt=""> 
                        <h4 class="namaMenu" style="color: #CC0E3C ;">Barang</h4>
                    </div>
                      </a>
                  </td>
                  <td>
                      <a href="/TB_PBD_B_KLP_7/FE/penjualan_daftar.php" style="text-decoration: none;">
                      <div class="menu" style="margin-right:40mm; margin-bottom: 10mm;text-align:center;">
                        <img src="/TB_PBD_B_KLP_7/Assets/recordpenjualan.svg" alt=""> 
                        <h4 class="namaMenu" style="color: #CC0E3C ;">Transaksi</h4>
                        </div>
                      </a>
                      
                  </td>
                </tr>
                <tr>
                    <td>
                        <a href="/TB_PBD_B_KLP_7/FE/supplier_daftar.php" style="text-decoration: none;">
                        <div class="menu" style="margin-right:40mm; margin-bottom: 10mm;text-align:center;">
                        <img src="/TB_PBD_B_KLP_7/Assets/datasupplier.svg" alt="">
                        <h4 class="namaMenu" style="color: #CC0E3C ;">Supplier</h4>
                          </div>
                        </a>
                    </td>
                  <td>
                      <a href="/TB_PBD_B_KLP_7/FE/pelanggan_daftar.php" style="text-decoration: none;">
                      <div class="menu" style="margin-right:40mm; margin-bottom: 10mm;text-align:center;">
                        <img src="/TB_PBD_B_KLP_7/Assets/datapelanggan.svg" alt="">    
                        <h4 class="namaMenu" style="color: #CC0E3C ;">Pelanggan</h4>
                        </div>
                      </a>
                </td>
                <tr>
                  <td>
                      <a href="/TB_PBD_B_KLP_7/FE/payment_daftar.php" style="text-decoration: none;">
                      <div class="menu" style="margin-right:40mm; margin-bottom: 10mm;text-align:center;">
                        <img src="/TB_PBD_B_KLP_7/Assets/datapelanggan.svg" alt="">    
                        <h4 class="namaMenu" style="color: #CC0E3C ;">Payment Method</h4>
                        </div>
                      </a>
                </td>
                  <td>
                      <a href="/TB_PBD_B_KLP_7/BE/logout.php" style="text-decoration: none;">
                      <div class="menu" style="margin-right:40mm; margin-bottom: 10mm;text-align:center;">
                        <img src="/TB_PBD_B_KLP_7/Assets/datapelanggan.svg" alt="">    
                        <h4 class="namaMenu" style="color: #CC0E3C ;">Log Out</h4>
                        </div>
                      </a>
                </td>

                </tr>
                </tr>

            </thead>
    </table>
      </div>
      </body>
</html>