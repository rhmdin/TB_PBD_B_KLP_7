<?php
session_start(); 
    include "connect.php";

    $idsup=$_GET['id'];
    $selectid = pg_query($connect, "SELECT COUNT(id_supplier) as id FROM tabel_supplier WHERE id_supplier = '$idsup'");
    $show = pg_fetch_assoc($selectid);
    if( $show ["id"] > 0 ){        
            
            $kontak = pg_escape_string($connect, $_POST["kontak"]);
            $alamat = pg_escape_string($connect, $_POST["alamat"]);
        
                    date_default_timezone_set('Asia/Jakarta');
                    $Tanggal = date('Y-m-d');	 
                    $update =  pg_query($connect, "UPDATE tabel_supplier SET kontak_supplier = $kontak, alamat_supplier = '$alamat' WHERE id_supplier = '$idsup'");
                    if($update){
                        echo "<script>
                                document.location.href='/TB_PBD_B_KLP_7/FE/supplier_daftar.php';
                            </script>";
                    }
                    else{
                        echo $idsup;
                    }
            
    }
    else{
        echo "<script>
                        alert('BARANG DENGAN ID $idsup TIDAK ADA!');
                        document.location.href='/tb_pbd_b_klp_7/FE/penjualan_tambah2.php?inv=$idsup';
            </script>";

    }
?>