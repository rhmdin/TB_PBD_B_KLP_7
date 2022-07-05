<?php
session_start(); 
    include "connect.php";
    if(empty($_POST["nama_pelanggan"]) || empty($_POST["kontak"]) || empty($_POST["alamat"]))  
	{
        echo "<script> 
                alert('DATA ADA YANG KOSONG!');
                document.location.href='/TB_PBD_B_KLP_7/FE/pelanggan_tambah.php';
            </script>";   
            }
    else{

        $id_pelanggan = pg_escape_string($connect,$_POST['id_pelanggan']);
        $selectid = pg_query($connect, "SELECT COUNT(id_pelanggan) as id FROM tabel_pelanggan WHERE id_pelanggan = '$id_pelanggan'");
        $show = pg_fetch_assoc($selectid);
        if( $show ["id"] > 0 ){
            echo "<script> 
                    alert('PELANGGAN DENGAN ID $id_pelanggan SUDAH ADA!');
                    document.location.href='/TB_PBD_B_KLP_7/FE/pelanggan_daftar.php';
                </script>"; 
        }
        else{
            $nama = pg_escape_string($connect,$_POST["nama_pelanggan"]);
            $kontak = pg_escape_string($connect, $_POST["kontak"]);
            $alamat = pg_escape_string($connect, $_POST["alamat"]);
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');	 
            $insert =  pg_query($connect, "INSERT INTO tabel_pelanggan ( id_pelanggan, nama_pelanggan, alamat_pelanggan, kontak_pelanggan) VALUES ($id_pelanggan, '$nama', '$alamat', $kontak)");
            if($insert)
            {
                if($_SESSION['add_cust'] == 'penjualan')
                {
                    echo "<script>
                        document.location.href='/TB_PBD_B_KLP_7/FE/penjualan_tambah.php';
                    </script>";
                }
                elseif($_SESSION['page'] == 'pelanggan')
                {
                    echo "<script>
                        document.location.href='/TB_PBD_B_KLP_7/FE/pelanggan_daftar.php';
                    </script>";
                } 
                echo $_SESSION['page'];
            }
            else
            {
                echo $_POST["id_pelanggan"];
            } 
        }
    }
       
?>