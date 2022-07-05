<?php
  session_start(); 
    include "connect.php";
    if(empty($_POST["nama_supplier"]) || empty($_POST["kontak_supplier"]) || empty($_POST["alamat_supplier"]) )  
	{  
        echo "<script> 
                alert('JANGAN ADA YANG KOSONG!');
                document.location.href='/TB_PBD_B_KLP_7/FE/supplier_tambah.php';
            </script>";  
	}
    else{
        
        $id_supplier = pg_escape_string($connect,$_POST['id_supplier']);
        $selectid = pg_query($connect, "SELECT COUNT(id_supplier) as id FROM tabel_supplier WHERE id_supplier = '$id_supplier'");
        $show = pg_fetch_assoc($selectid);
        if( $show ["id"] > 0 ){
            echo "<script> 
                    alert('SUPPLIER DENGAN ID $id_supplier SUDAH ADA!');
                    document.location.href='/TB_PBD_B_KLP_7/FE/supplier_daftar.php';
                </script>"; 
        }
        else{
            $nama = pg_escape_string($connect,$_POST["nama_supplier"]);
            $kontak = pg_escape_string($connect, $_POST["kontak_supplier"]);
            $alamat = pg_escape_string($connect, $_POST["alamat_supplier"]);
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');	 
            $insert =  pg_query($connect, "INSERT INTO tabel_supplier ( id_supplier, nama_supplier, alamat_supplier, kontak_supplier) VALUES ($id_supplier, '$nama', '$alamat', $kontak)");
            if($insert)
            {
                if($_SESSION['page'] == 'null'){
                    echo "<script>
                        document.location.href='/TB_PBD_B_KLP_7/FE/supplier_daftar.php';
                    </script>";
                }
                elseif($_SESSION['page'] == 'add_brg'){
                    echo "<script>
                        document.location.href='/TB_PBD_B_KLP_7/FE/barang_tambah.php';
                    </script>";
                }
            }
            else
            {
                echo $_POST["id_supplier"];
            } 
        }
    
    }     
?>