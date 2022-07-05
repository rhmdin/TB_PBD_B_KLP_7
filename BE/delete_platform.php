<?php 
session_start(); 
include "connect.php";
$id=$_GET['id'];
$del = pg_query($connect, "DELETE FROM tabel_platform_pembayaran WHERE id = $id ");

if($del){
	header("location:/TB_PBD_B_KLP_7/FE/payment_daftar.php");
} 
else{
	header("location:/TB_PBD_B_KLP_7/FE/payment_index.php?id=$id");

}
?>