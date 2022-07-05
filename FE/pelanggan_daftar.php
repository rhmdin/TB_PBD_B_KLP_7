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
  $select = pg_query($connect, "SELECT * FROM tabel_pelanggan ORDER BY id_pelanggan ASC");
  }?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
    <link rel="stylesheet" href="/TB_PBD_B_KLP_7/Style/daftar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>            
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script
        src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"
        crossorigin="anonymous">
    </script>        
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="position:fixed; margin-top:0%; width:100%">
    <a  href="/TB_PBD_B_KLP_7/FE/index_kasir.php">
      <img class="logo" src="/TB_PBD_B_KLP_7/Assets/logo_delmora.png" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
      <ul class="navbar-nav " style="margin-left: 89.9%;" >
        <li class="nav-item dropdown" >
          <a  class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $akun ['nama'] ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="margin-left: -150%;">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/tb_pbd_b_klp_7/BE/logout.php">Keluar</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <br>
  <center><p class="judul">Daftar Pelanggan</p></center>
  
    <div class="containerForm" style="padding: 8%; height: 100%;"> 
       
    <button class="addbtn">
          <a href="pelanggan_tambah.php" onclick="<?php $_SESSION ['page'] = 'pelanggan';
                                                        $_SESSION ['page1'] = 'pelanggan'; ?> ?>">
            Tambah
          </a>
        </button>

        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ID</th>
                    <th>NAMA</th>
                    <th>KONTAK</th>
                    <th>ALAMAT</th>
                    <th style="column-width: 1cm;">AKSI</th>
                </tr>
            </thead>
            <tbody>
          <?php
              $i=1;
              while ($show = pg_fetch_assoc($select))
              {
          ?>
            <tr>
                <td ><?php echo $i++; ?></td>
                <td ><?php echo $show ['id_pelanggan'];?></td>
                <td ><?php echo $show ['nama_pelanggan'];?></td>
                <td ><?php echo $show ['kontak_pelanggan'];?></td>
                <td ><?php echo $show ['alamat_pelanggan'];?></td>
                <td class="btnaksi">
                  <a href="/TB_PBD_B_KLP_7/FE/pelanggan_edit.php?id=<?php echo $show ['id_pelanggan']?>">
                    <button
                            type="button" title="Edit data"
                            class="btn btn-warning"
                            style="background-color: #e15b29"
                          >
                            <i class="fa fa-pencil" style="color: white"></i>
                          </button>
                  </a>
                        
                        <a href="/TB_PBD_B_KLP_7/BE/delete_pelanggan.php?id=<?php echo $show ['id_pelanggan']?>" style="text-decoration: none;" >
                          <button type="button" class="btn btn-danger" title="Hapus data" OnClick="return confirm('Yakin mau hapus data pelanggan dengan ID <?php echo $show ['id_pelanggan']?>?\nData yang dihapus tidak dapat dikembalikan!');">
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </a>
                    </td>
              </tr>
          <?php
              }
          ?>
        </tbody>
        </table>


        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src=" https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
        <script src="/TB_PBD_B_KLP_7/Style/datatable.js"></script>
         <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
    </div>
</body>
</html>