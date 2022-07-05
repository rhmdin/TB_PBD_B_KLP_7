<?php
session_start(); 
    include "connect.php";
    if(empty($_POST["username"]) || empty($_POST["nama"]) || empty($_POST["nohp"]) || empty($_POST["role"]) || empty($_POST["password"]) || empty($_POST["password1"])){

        echo "<script> 
                alert('DATA ADA YANG KOSONG!');
                document.location.href='/TB_PBD_B_KLP_7/FE/pelanggan_tambah.php';
            </script>"; 
    }  
    
    else{
        
    $usn = strtoupper(pg_escape_string($connect,$_POST['username']));
    $selectid = pg_query($connect, "SELECT COUNT(username) as id FROM tabel_daftar_user WHERE username = '$usn'");
    $show = pg_fetch_assoc($selectid);
    if( $show ["id"] > 0 ){
        echo "<script> 
                alert('PELANGGAN DENGAN USERNAME $usn SUDAH ADA!');
                document.location.href='/TB_PBD_B_KLP_7/FE/user_daftar.php';
            </script>"; 
    }
    else{
        $pw = pg_escape_string($connect, $_POST["password"]);
        $pw1 = pg_escape_string($connect, $_POST["password1"]);
        if($pw==$pw1){
            $username = pg_escape_string($connect,$_POST["username"]);
            $role = pg_escape_string($connect, $_POST["role"]);
            $password = password_hash($pw, PASSWORD_DEFAULT);
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');	 
            $insert =  pg_query($connect, "INSERT INTO tabel_daftar_user ( username, role_user, password) VALUES ('$username', '$role', '$password')");
            if($insert)
            {
                echo "<script>
                        document.location.href='/TB_PBD_B_KLP_7/FE/user_daftar.php';
                    </script>";
            }
            else
            {
                echo "<script> 
                        alert('GAGAL MENAMBAHKAN DATA!');
                        document.location.href='/TB_PBD_B_KLP_7/FE/user_daftar.php';
                    </script>"; 
            } 
        }
        else{
            
            echo "<script> 
            alert('PASSWORD DAN KONFIRMASI PASSWORD TIDAK COCOK');
            document.location.href='/TB_PBD_B_KLP_7/FE/user_tambah.php';
        </script>"; 
        }
    }
    }
       
?>