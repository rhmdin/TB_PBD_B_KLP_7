<?php 
session_start(); 
include "connect.php";
$id=$_GET['id'];
$jmlbrg = pg_query($connect, "SELECT max(id_barang) as idmax FROM tabel_barang WHERE id_supplier = $id");
$showjmlbrg = pg_fetch_assoc($jmlbrg);
$idmax = $showjmlbrg['idmax'];
if($jmlbrg){
	for( $x=0; $x<=$idmax ; $x++){
		$brg = pg_query($connect, "SELECT * FROM tabel_barang WHERE id_barang = $x");
		$showbrg = pg_fetch_assoc($brg);
		if($showbrg['id_supplier'] == $id){
			$newidbrg = 0;
			$updt = pg_query($connect, "UPDATE tabel_barang SET id_supplier = $newidbrg  WHERE id_supplier = $id ");
			if($updt){
				$del = pg_query($connect, "DELETE FROM tabel_supplier WHERE id_supplier = $id ");
			}
			else{
				header("location:/TB_PBD_B_KLP_7/FE/supplier_index.php?gagalupdateid=$idmax");
			}
		}
	}
}
else{
	$del = pg_query($connect, "DELETE FROM tabel_supplier WHERE id_supplier = $id ");
}

if($del){
	header("location:/TB_PBD_B_KLP_7/FE/supplier_daftar.php");
}
else{
}
?>