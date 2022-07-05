<?php
session_start(); 
    include "connect.php";

    $usn=$_GET['usn'];
    $selectid = pg_query($connect, "SELECT COUNT(username) as usn FROM tabel_daftar_user WHERE username = '$usn'");
    $show = pg_fetch_assoc($selectid);
    if( $show ["usn"] > 0 ){        
            
            $nama = pg_escape_string($connect, $_POST["nama"]);
            $nohp = pg_escape_string($connect, $_POST["nohp"]);
            $role = pg_escape_string($connect, $_POST["role"]);
        
                    date_default_timezone_set('Asia/Jakarta');
                    $Tanggal = date('Y-m-d');	 
                    $update =  pg_query($connect, "UPDATE tabel_daftar_user SET nama = '$nama', no_hp = $nohp, role_user = $role WHERE username = '$usn'");
                    if($update){
                        echo "<script>
                                document.location.href='/TB_PBD_B_KLP_7/FE/user_daftar.php';
                            </script>";
                    }
                    else{
                        echo $usn;
                    }
            
    }
    else{
        echo "<script>
                        alert('USER DENGAN ID $usn TIDAK ADA!');
                        document.location.href='/tb_pbd_b_klp_7/FE/user_daftar.php';
            </script>";

    }
?>