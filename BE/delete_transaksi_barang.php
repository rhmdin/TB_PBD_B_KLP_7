<?php 
session_start(); 
include "connect.php";
$noInvoice=$_GET['inv'];
$idbrg=$_GET['idbrg'];
$del = pg_query($connect, "DELETE FROM tabel_detail_transaksi WHERE no_invoice = $noInvoice AND id_barang = $idbrg");

if($del){
    $_SESSION['hpsbrg']= "hpsbrg";
	header("location:/TB_PBD_B_KLP_7/FE/penjualan_tambah2.php?inv=$noInvoice");
} 
else{
	header("location:index_kasirr.php");
}
?>