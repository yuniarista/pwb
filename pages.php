<?php
    $_userid = isset($_SESSION["id_user"]) ? $_SESSION["id_user"] : "";
    $_userrole = isset($_SESSION["role_user"]) ? $_SESSION["role_user"] : "";
    if ($_userid == '') {
        header('location:index.php?page=login');
    }

    include('koneksi.php');
    $_pages = isset($_REQUEST["page"]) ? $_REQUEST["page"] : 'default';
    switch ($_pages) {
        // default
        case 'default':
            $_SESSION["titlepage"] = "Dashboard Sistem";
            include "pages/dashboard.php";
        break;

        // dashboard
        case 'dashboard':
            $_SESSION["titlepage"] = "Dashboard Sistem";
            include "pages/dashboard.php";
        break;

        // berita
        case 'berita':
            $_SESSION["titlepage"] = "Data Berita";
            include "pages/berita.php";
        break;
        
        // tambah berita
        case 'berita-add':
            $_SESSION["titlepage"] = "Tambah Data Berita";
            include "pages/berita-add.php";
        break;
        
        // edit berita
        case 'berita-edit':
            $_SESSION["titlepage"] = "Edit Data Berita";
            include "pages/berita-edit.php";
        break;
        
        // hapus berita
        case 'berita-delete':
            $id_berita = isset($_GET['id_berita']) ? $_GET['id_berita'] : '';
            if ($id_berita != '') {
                $sqlcheck = "SELECT * FROM tbl_berita WHERE id_berita = $id_berita and user_berita = $_userid";
                if ($_userrole == 'admin') {
                    $sqlcheck = "SELECT * FROM tbl_berita WHERE id_berita = $id_berita";
                }
                $qrycheck = mysqli_query($_koneksi, $sqlcheck);
                $databerita = $qrycheck->fetch_array();
                if (count($databerita) > 0) {
                    $sqldel = "DELETE FROM tbl_berita WHERE id_berita = $id_berita";
                    $qrydel = mysqli_query($_koneksi, $sqldel);
                    if ($qrydel) {
                        unlink('files/'.$databerita['img_berita']);
                        header('location:index.php?page=berita');
                    }
                } else {
                    echo "Data tidak ditemukan!";
                }
            } else {
                echo "Data tidak ditemukan!";
            }
        break;
        
        // user
        case 'user':
            $_SESSION["titlepage"] = "Data User";
            if ($_userrole == 'admin') {
                include "pages/user.php";
            } else {
                echo "Unauthorized user!";
            }
        break;

        // user add
        case 'user-add':
            $_SESSION["titlepage"] = "Tambah Data User";
            if ($_userrole == 'admin') {
                include "pages/user-add.php";
            } else {
                echo "Unauthorized user!";
            }
        break;

        // edit user
        case 'user-edit':
            $_SESSION["titlepage"] = "Edit Data User";
            if ($_userrole == 'admin') {
                include "pages/user-edit.php";
            } else {
                echo "Unauthorized user!";
            }
        break;

        // hapus user
        case 'user-delete':
            $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : '';
            if ($id_user != '') {
                $sqlcheck = "SELECT * FROM tbl_user WHERE id_user = $id_user";
                $qrycheck = mysqli_query($_koneksi, $sqlcheck);
                $datauser = $qrycheck->fetch_array();
                if (count($datauser) > 0) {
                    $sqldel = "DELETE FROM tbl_user WHERE id_user = $id_user";
                    $qrydel = mysqli_query($_koneksi, $sqldel);
                    if ($qrydel) {
                        header('location:index.php?page=user');
                    }
                } else {
                    echo "Data tidak ditemukan!";
                }
            } else {
                echo "Data tidak ditemukan!";
            }
        break;

        // logout
        case 'logout':
            $_SESSION["titlepage"] = "Logout Sistem";
            unset($_SESSION['id_user']);
            unset($_SESSION['username']);
            unset($_SESSION['nama_user']);
            unset($_SESSION['role_user']);
            // redirect
            header('location:index.php?page=login');
        break;

        // testing
        case 'testing':
            $_SESSION["titlepage"] = "Testing page";
            echo 'Ini halaman testing';
        break;
        
        default:
            $_SESSION["titlepage"] = "Halaman tidak ditemukan!";
            include "pages/public-notfound.php";
        break;
    }
?>