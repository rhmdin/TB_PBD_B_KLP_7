<?php 
session_start(); 
include "connect.php";
$id=$_GET['id'];
$del = pg_query($connect, "DELETE FROM tabel_supplier WHERE id_supplier = $id ");

if($del){
	header("location:/TB_PBD_B_KLP_7/FE/supplier_daftar.php");
} 
else{
	header("location:/TB_PBD_B_KLP_7/FE/supplier_index.php?id=$id");

}
?>