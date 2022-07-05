<?php 
session_start(); 
include "connect.php";
$noInvoice=$_GET['inv'];
$del = pg_query($connect, "DELETE FROM tabel_transaksi WHERE no_invoice = $noInvoice ");

if($del){
	header("location:/TB_PBD_B_KLP_7/FE/penjualan_daftar.php");
} 
else{
	header("location:index_kasirr.php");

}
?>