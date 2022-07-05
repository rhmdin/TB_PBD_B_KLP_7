<?php 
// mengaktifkan session php
session_start();
 
// menghapus semua session
session_destroy();
 
// mengalihkan halaman ke halaman login
header("location:/TB_PBD_B_KLP_7/index.php");
?>