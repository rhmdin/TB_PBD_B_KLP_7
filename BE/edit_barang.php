<?php
session_start(); 
    include "connect.php";

    $idBarang=$_GET['idbrg'];
    $selectid = pg_query($connect, "SELECT COUNT(id_barang) as id FROM tabel_barang WHERE id_barang = '$idBarang'");
    $show = pg_fetch_assoc($selectid);
    if( $show ["id"] > 0 ){        
            
            $modal = pg_escape_string($connect, $_POST["modal"]);
            $jual = pg_escape_string($connect, $_POST["jual"]);
        if($jual<$modal){
            echo "<script> 
                    alert('HARGA JUAL HARUS LEBIH BESAR DARI HARGA BELI!');
                    document.location.href='/TB_PBD_B_KLP_7/FE/barang_edit.php?idbrg=$idBarang';
                </script>";  
        }
        else{
            date_default_timezone_set('Asia/Jakarta');
            $Tanggal = date('Y-m-d');	 
            $update =  pg_query($connect, "UPDATE tabel_barang SET harga_beli = $modal, harga_jual = $jual WHERE id_barang = '$idBarang'");
            if($update){
                echo "<script>
                        document.location.href='/TB_PBD_B_KLP_7/FE/barang_daftar.php';
                    </script>";
            }
            else{
                echo $idBarang;
            }
        }
                  
            
    }
    else{
        echo "<script>
                        alert('BARANG DENGAN ID $barang TIDAK ADA!');
                        document.location.href='/tb_pbd_b_klp_7/FE/penjualan_tambah2.php?inv=$noInvoice';
            </script>";

    }
?>