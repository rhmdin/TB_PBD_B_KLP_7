<?php

session_start(); 
    include "connect.php";
    $Username=$_SESSION['Username'];
    if(empty($_POST['noInvoice']) || empty($_POST["pelanggan"]) || empty($_POST["payment"]))  
	{
        echo "<script> 
                alert('DATA ADA YANG KOSONG!');
                document.location.href='/TB_PBD_B_KLP_7/FE/penjualan_tambah.php';
            </script>";   
    }
    else{   
        $noInvoice = pg_escape_string($connect,$_POST['noInvoice']);
        $selectid = pg_query($connect, "SELECT COUNT(no_invoice) as inv FROM tabel_transaksi WHERE no_invoice = '$noInvoice'");
        $show = pg_fetch_assoc($selectid);
        if( $show ["inv"] > 0 ){
            echo "<script> 
                    alert('BARANG DENGAN ID $noInvoice SUDAH ADA!');
                    document.location.href='/TB_PBD_B_KLP_7/FE/index_kasir.php';
                </script>"; 
        }
        else{
            $pelanggan = pg_escape_string($connect,$_POST["pelanggan"]);
            date_default_timezone_set('Asia/Jakarta');
            $Tanggal = date('Y-m-d h:i:s');	 
            $kasir = 'Dm1';
            $ongkir = pg_escape_string($connect, $_POST["ongkir"]);
            $eallowed_exts= array('png','jpg','jpeg');
            $nota = $_FILES['nota']['name'];
            $nota = $_FILES['bukti']['name'];
            $x = explode('.', $nota);
            $ext = strtolower(end($x));
            $ukuran	= $_FILES['nota']['size'];
            $file_tmp = $_FILES['nota']['tmp_name'];	
    
            if(in_array($ext, $eallowed_exts) === true){
                if($ukuran <= 5000000)
                {	
                    move_uploaded_file($file_tmp, 'C:xampp\htdocs\TB_PBD_B_KLP_7\Assets\\'.$nota);
                    $insert =  pg_query($connect, "INSERT INTO tabel_transaksi ( id_pelanggan, id_kasir, no_invoice, tanggal, nota_pembayaran, ongkir) VALUES ($pelanggan,'$kasir','$noInvoice','$Tanggal','$nota', $ongkir)");
                    if($insert)
                    {
                        echo "<script>
                                document.location.href='/TB_PBD_B_KLP_7/FE/penjualan_tambah_barang.php?inv=$noInvoice';
                            </script>";
                    }
                    else
                    {
                        echo $_POST["pelanggan"];
                    } 
                
                }
                else{
                        echo "<script> 
                                alert('UKURAN FOTO LEBIH DARI 50 MB!');
                                    document.location.href='/TB_PBD_B_KLP_7/FE/penjualan_tambah.php';
                            </script>";  
                }
            }
            else{
                echo "<script> 
                alert('EKSTENSI FILE TERLARANG!');
                    document.location.href='/TB_PBD_B_KLP_7/FE/penjualan_tambah.php';
                </script>";  
            }
        }
    }
?>