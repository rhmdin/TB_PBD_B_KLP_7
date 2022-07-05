<?php 
session_start(); 
include "connect.php";
$id=$_GET['usn'];
$del = pg_query($connect, "DELETE FROM tabel_daftar_user WHERE username ='$id'");

if($del){
	header("location:/TB_PBD_B_KLP_7/FE/user_daftar.php");
} 
else{
	echo $id;

}
?>