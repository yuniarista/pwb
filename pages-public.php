<?php
    $_userid = isset($_SESSION["id_user"]) ? $_SESSION["id_user"] : "";
    $_userrole = isset($_SESSION["role_user"]) ? $_SESSION["role_user"] : "";
    if ($_userid != '') {
        header('location:index.php?page=dashboard');
    }

    include('koneksi.php');
    $_pages = isset($_REQUEST["page"]) ? $_REQUEST["page"] : 'default';
    switch ($_pages) {
        // default
        case 'default':
            $_SESSION["titlepage"] = "Halaman Utama - Portal Berita";
            include "pages/public-berita.php";
        break;

        // login
        case 'login':
            $_SESSION["titlepage"] = "Login Sistem";
            include "pages/login.php";
        break;
        
        default:
            $_SESSION["titlepage"] = "Halaman tidak ditemukan!";
            include "pages/public-notfound.php";
        break;
    }
?>