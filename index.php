<?php
    ob_start();
    session_start();
    $_userid = isset($_SESSION["id_user"]) ? $_SESSION["id_user"] : "";
    $_titlepage = isset($_SESSION["titlepage"]) ? $_SESSION["titlepage"] : "Portal Berita";
?>
<html>
    <head>
        <?php require_once('parts/inc_meta.php');?>
        <title><?php echo $_titlepage;?></title>
    </head>
    <body>
        <!-- navigasi -->
        <?php
            if ($_userid != "") {
                include 'parts/navigasi.php';
            } else {
                include 'parts/navigasi-public.php';
            }
        ?>
        
        <!-- kontent -->
        <div class="container custom-container my-3">
            <!-- page content -->
            <?php
                if ($_userid != "") {
                    include 'pages.php';
                } else {
                    include 'pages-public.php';
                }
            ?>
        </div>

        <!-- footer -->
        <footer class="footer bg-dark text-light">
            <div class="container text-center">
                <span class="text-muted">SI Portal Berita</span>
            </div>
        </footer>

        <?php require_once('parts/inc_js.php');?>
    </body>
</html>