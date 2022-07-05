<?php

session_start(); 
    include "connect.php";
    if(empty($_POST["id"]) || empty($_POST["payment"]) || empty($_POST["no"]) || empty($_POST["nama"]))  
	{  
        echo "<script> 
                alert('JANGAN ADA YANG KOSONG!');
                document.location.href='/TB_PBD_B_KLP_7/FE/payment_tambah.php';
            </script>";  
	}
    else{
        $id = pg_escape_string($connect,$_POST['id']);
        $no = pg_escape_string($connect,$_POST['id']);
        $selectid = pg_query($connect, "SELECT COUNT(id) as id FROM tabel_platform_pembayaran WHERE id = '$id'");
        $show = pg_fetch_assoc($selectid);
        if( $show ["id"] > 0 ){
            echo "<script> 
                    alert('PAYMENT METHOD DENGAN ID $id SUDAH ADA!');
                    document.location.href='/TB_PBD_B_KLP_7/FE/payment_daftar.php';
                </script>"; 
        }
        else{
            echo $id;
            $payment = pg_escape_string($connect, $_POST["payment"]);
            $nama = pg_escape_string($connect, $_POST["nama"]);
            $insert =  pg_query($connect, "INSERT INTO tabel_platform_pembayaran ( id, platform, nomor, nama) VALUES ($id, '$payment', '$no', '$nama')");
            if($insert)
                {
                    if($_SESSION['page'] == 'read_pay'){
                        echo "<script>
                            document.location.href='/TB_PBD_B_KLP_7/FE/payment_daftar.php';
                        </script>";
                    }
                    elseif($_SESSION['page'] == 'add_pay'){
                        echo "<script>
                            document.location.href='/TB_PBD_B_KLP_7/FE/penjualan_tambah.php';
                        </script>";
                    }
                }
            else
                {
                    echo "<script> 
                            alert('BARANG DENGAN ID $id GAGAL DITAMBAHKAN!');
                            document.location.href='/TB_PBD_B_KLP_7/FE/payment_daftar.php';
                        </script>"; 
                } 
            }
        }
    
       
?>