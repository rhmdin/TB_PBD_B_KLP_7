<?php

session_start(); 
    include "connect.php";
    if(empty($_POST["id_barang"]) || empty($_POST["nama_barang"]) || empty($_POST["harga_beli"]) || empty($_POST["harga_jual"]) || empty($_POST["supplier"]))  
	{  
        echo "<script> 
                alert('JANGAN ADA YANG KOSONG!');
                document.location.href='/TB_PBD_B_KLP_7/FE/barang_tambah.php';
            </script>";  
	}
    else{
        $id_barang = pg_escape_string($connect,$_POST['id_barang']);
        $selectid = pg_query($connect, "SELECT COUNT(id_barang) as id FROM tabel_barang WHERE id_barang = '$id_barang'");
        $show = pg_fetch_assoc($selectid);
        if( $show ["id"] > 0 ){
            echo "<script> 
                    alert('BARANG DENGAN ID $id_barang SUDAH ADA!');
                    document.location.href='/TB_PBD_B_KLP_7/FE/barang_daftar.php';
                </script>"; 
        }
        else{
            $hb = pg_escape_string($connect, $_POST["harga_beli"]);
            $hj = pg_escape_string($connect, $_POST["harga_jual"]);
            if($hj<=$hb){
                echo "<script> 
                    alert('HARGA JUAL HARUS LEBIH BESAR DARI HARGA BELI!');
                    document.location.href='/TB_PBD_B_KLP_7/FE/barang_tambah.php';
                </script>";  
            }
            else{
                $nama = pg_escape_string($connect,$_POST["nama_barang"]);
                $supplier = pg_escape_string($connect, $_POST["supplier"]);
                date_default_timezone_set('Asia/Jakarta');
                $tanggal = date('Y-m-d');	 
                $insert =  pg_query($connect, "INSERT INTO tabel_barang ( id_barang, nama_barang, harga_beli, harga_jual, id_supplier) VALUES ($id_barang, '$nama', '$hb', $hj, $supplier)");
                if($insert)
                {
                    if($_SESSION['page'] == 'add_brg')
                    {
                        echo "<script>
                            document.location.href='/TB_PBD_B_KLP_7/FE/barang_daftar.php';
                        </script>";
                    }
                    elseif($_SESSION['page'] == 'read_brg')
                    {
                        echo "<script>
                            document.location.href='/TB_PBD_B_KLP_7/FE/barang_tambah.php';
                        </script>";
                    } 
                }
                else
                {
                    echo "<script> 
                            alert('BARANG DENGAN ID $id_barang GAGAL DITAMBAHKAN!');
                            document.location.href='/TB_PBD_B_KLP_7/FE/barang_daftar.php';
                        </script>"; 
                } 
            }
        }
    }
       
?>