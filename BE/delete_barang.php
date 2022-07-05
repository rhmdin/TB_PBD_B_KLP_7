<?php 
session_start(); 
include "connect.php";
$id=$_GET['id'];
$del = pg_query($connect, "DELETE FROM tabel_barang WHERE id_barang = $id ");

if($del){
	header("location:/TB_PBD_B_KLP_7/FE/barang_daftar.php");
} 
else{
	header("location:/TB_PBD_B_KLP_7/FE/barang_index.php?id=$id");

}
?>