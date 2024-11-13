<?php 
  $_host       = "localhost";
  $_user       = "root";
  $_password   = "";
  $_database   = "db_berita";
  $_port       = "3307";
  $_koneksi    = mysqli_connect($_host, $_user, $_password, $_database, $_port) or die(mysqli_error($_koneksi));
?>