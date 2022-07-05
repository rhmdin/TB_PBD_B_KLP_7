<?php
//mulai session

use LDAP\Result;

session_start(); 
include "connect.php";

if(empty($_POST["Username"]) || empty($_POST["Password"]))  
{            
	echo '<script>
            alert("Username dan Password Tidak Boleh Kosong!")
          </script>';  
}  
else{
    $Username = strtolower(pg_escape_string($connect, $_POST["Username"]));
    $Password = pg_escape_string($connect, $_POST["Password"]);
    $select = pg_query($connect, "SELECT * FROM tabel_daftar_user WHERE username = '$Username'");
    $result = pg_fetch_assoc($select);
    if($result==true){
        if(password_verify($Password, $result["password"])){
            if($result["role_user"]=="1"){
                $_SESSION['Username'] = $Username;
                $_SESSION['role'] = "1";
                header("location:/tb_pbd_b_klp_7/FE/user_daftar.php");
            }
            elseif($result["role_user"]=="2"){
                $_SESSION['Username'] = $Username;
                $_SESSION['role'] = "2";
                header("location:/tb_pbd_b_klp_7/FE/index_atasan.php");
            }
            elseif($result["role_user"]=="3"){
                $_SESSION['Username'] = $Username;
                $_SESSION['role'] = "3";
                header("location:/tb_pbd_b_klp_7/FE/index_kasir.php");
            }
        }
        else{
            echo "Password Salah";
            $_SESSION['Username'] = $Username;
            $_SESSION['Password'] = $Password;
            header("location:/tb_pbd_b_klp_7/index.php?msg=invalidpw");
        }
    }
    else{
        $_SESSION['Username'] = $Username;
        $_SESSION['Password'] = $Password;
        header("location:/tb_pbd_b_klp_7/index.php?msg=invalidacc");
    }
}
?>