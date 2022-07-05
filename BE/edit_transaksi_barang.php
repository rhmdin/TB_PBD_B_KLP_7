<?php
session_start(); 
    include "connect.php";

    $noInvoice=$_GET['inv'];
    $idBarang=$_GET['idbrg'];
    $selectid = pg_query($connect, "SELECT COUNT(id_barang) as id FROM tabel_detail_transaksi WHERE no_invoice = '$noInvoice' AND id_barang = '$idBarang'");
    $show = pg_fetch_assoc($selectid);
    if( $show ["id"] > 0 ){        
            $selectbrg = pg_query($connect, "SELECT * FROM tabel_barang WHERE id_barang = '$idBarang'");
            $result = pg_fetch_assoc($selectbrg);
            
            $modal = $result["harga_beli"];
            $jual = $result["harga_jual"];
            $qty = pg_escape_string($connect, $_POST["jumlah"]);
            $diskon = pg_escape_string($connect, $_POST["diskon"]);
            $sub_total = (($qty *  $jual) + $ongkir - $diskon);
        
                    date_default_timezone_set('Asia/Jakarta');
                    $Tanggal = date('Y-m-d');	 
                    $update =  pg_query($connect, "UPDATE tabel_detail_transaksi SET diskon = $diskon, kuantitas_barang = $qty  WHERE no_invoice = '$noInvoice' AND id_barang = '$idBarang'");
                    if($update){
                        echo "<script>
                                document.location.href='/TB_PBD_B_KLP_7/FE/penjualan_tambah2.php?inv=$noInvoice';
                            </script>";
                    }
                    else{
                        echo $noInvoice;
                    }
            
    }
    else{
        echo "<script>
                        alert('BARANG DENGAN ID $barang TIDAK ADA!');
                        document.location.href='/tb_pbd_b_klp_7/FE/penjualan_tambah2.php?inv=$noInvoice';
            </script>";

    }
?>