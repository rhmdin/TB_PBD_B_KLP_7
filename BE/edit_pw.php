<?php
session_start(); 
    include "connect.php";
    $Username=$_SESSION['Username'];
    $usn=$_GET['usn'];
    $select = pg_query($connect, "SELECT * FROM tabel_daftar_user WHERE username = '$Username'");  
$akun=pg_fetch_assoc($select);

    if(empty($_POST["password"]) || empty($_POST["password1"])){

        echo "<script> 
                alert('DATA ADA YANG KOSONG!');
                document.location.href='/TB_PBD_B_KLP_7/FE/gantipw.php';
            </script>"; 
    }  
    
    else{
       
        $pw = pg_escape_string($connect, $_POST["password"]);
        $pw1 = pg_escape_string($connect, $_POST["password1"]);
        if($pw==$pw1){
            $password = password_hash($pw, PASSWORD_DEFAULT);
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');	 
            $insert =  pg_query($connect, "UPDATE tabel_daftar_user SET password='$password' WHERE username = '$usn'");
            if($insert)
            {
                if($_SESSION['role']==1){
                    echo "<script>
                            document.location.href='/TB_PBD_B_KLP_7/FE/user_daftar.php';
                        </script>";
                    
                }
                elseif($_SESSION['role']==2){
                    echo "<script>
                            document.location.href='/TB_PBD_B_KLP_7/FE/index_atasan.php';
                        </script>";

                }
                elseif($_SESSION['role']==3){
                    echo "<script>
                            document.location.href='/TB_PBD_B_KLP_7/FE/penjualan_daftar.php';
                        </script>";
                    
                }
            }
            else
            {
               
            } 
        }
        else{
            
            echo "<script> 
            alert('PASSWORD DAN KONFIRMASI PASSWORD TIDAK COCOK');
            document.location.href='/TB_PBD_B_KLP_7/FE/user_tambah.php';
        </script>"; 
        }
    }
       
?>