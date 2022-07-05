<?php
session_start(); 
    include "connect.php";

    $idcus=$_GET['id'];
    $selectid = pg_query($connect, "SELECT COUNT(id_pelanggan) as id FROM tabel_pelanggan WHERE id_pelanggan = '$idcus'");
    $show = pg_fetch_assoc($selectid);
    if( $show ["id"] > 0 ){        
            
            $kontak = pg_escape_string($connect, $_POST["kontak"]);
            $alamat = pg_escape_string($connect, $_POST["alamat"]);
        
                    date_default_timezone_set('Asia/Jakarta');
                    $Tanggal = date('Y-m-d');	 
                    $update =  pg_query($connect, "UPDATE tabel_pelanggan SET kontak_pelanggan = $kontak, alamat_pelanggan = '$alamat' WHERE id_pelanggan = '$idcus'");
                    if($update){
                        echo "<script>
                                document.location.href='/TB_PBD_B_KLP_7/FE/pelanggan_daftar.php';
                            </script>";
                    }
                    else{
                        echo $idcus;
                    }
            
    }
    else{
        echo "<script>
                        alert('BARANG DENGAN ID $idcus TIDAK ADA!');
                        document.location.href='/tb_pbd_b_klp_7/FE/penjualan_tambah2.php?inv=$idsup';
            </script>";

    }
?>