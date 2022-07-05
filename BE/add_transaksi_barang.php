<?php
session_start(); 
    include "connect.php";

    $noInvoice=$_GET['inv'];
    $qty = pg_escape_string($connect, $_POST["jumlah"]);
    $diskon = pg_escape_string($connect, $_POST["diskon"]);
    $barang = pg_escape_string($connect,$_POST["barang"]);
    
    
        $selectid = pg_query($connect, "SELECT COUNT(id_barang) as id FROM tabel_detail_transaksi WHERE no_invoice = '$noInvoice' AND id_barang = '$barang'");
        $show = pg_fetch_assoc($selectid);
        if( $show ["id"] > 0 ){
            echo "<script>
                            alert('BARANG DENGAN ID $barang SUDAH DITAMBAHKAN!');
                            document.location.href='/tb_pbd_b_klp_7/FE/penjualan_tambah2.php?inv=$noInvoice';
                </script>";
        }
        else{
            $selectbrg = pg_query($connect, "SELECT * FROM tabel_barang WHERE id_barang = '$barang'");
        $result = pg_fetch_assoc($selectbrg);
        $modal = $result["harga_beli"];
        $jual = $result["harga_jual"];
        $sub_total = $qty *  $jual;
        $selectdtl = pg_query($connect, "SELECT max(id_detail) as max FROM tabel_detail_transaksi");
        $resultdtl = pg_fetch_assoc($selectdtl);

        if($resultdtl["max"]>0){
            $idDetail = $resultdtl["max"] + 1;
        }
        else{
            $idDetail = 1;
        }

                date_default_timezone_set('Asia/Jakarta');
                $Tanggal = date('Y-m-d');	 
                $insert =  pg_query($connect, "INSERT INTO tabel_detail_transaksi 
                                                (diskon, no_invoice, id_detail, kuantitas_barang, id_barang) 
                                                VALUES ($diskon,$noInvoice,$idDetail,$qty, $barang)");
                if($insert){
                    echo "<script>
                            document.location.href='/TB_PBD_B_KLP_7/FE/penjualan_tambah2.php?inv=$noInvoice';
                        </script>";
                }
                else{
                    echo $noInvoice;
                }
        }
    
?>