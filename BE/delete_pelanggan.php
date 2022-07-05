<?php 
session_start(); 
include "connect.php";
$id=$_GET['id'];
$del = pg_query($connect, "DELETE FROM tabel_pelanggan WHERE id_pelanggan = $id ");

if($del){
	header("location:/TB_PBD_B_KLP_7/FE/pelanggan_daftar.php");
} 
else{
	header("location:/TB_PBD_B_KLP_7/FE/pelanggan_index.php?id=$id");

}
?>