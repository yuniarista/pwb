<?php
    if (isset($_POST['tombol-login'])) {
        $errormsg = '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        if ($username != '' && $password != '') {
            $sqlcheck = "SELECT * FROM tbl_user WHERE username = '$username'";
            $qrycheck = mysqli_query($_koneksi, $sqlcheck);
            $datalogin = $qrycheck->fetch_assoc();
            if (count($datalogin) > 0) {
                if ($datalogin['status'] == 'aktif') {
                    if (md5($password) == $datalogin['password']) {
                        // create session
                        $_SESSION['id_user'] = $datalogin['id_user'];
                        $_SESSION['username'] = $datalogin['username'];
                        $_SESSION['nama_user'] = $datalogin['nama_user'];
                        $_SESSION['role_user'] = $datalogin['role_user'];
                        // redirect
                        header('location:index.php');
                    } else {
                        $errormsg = '<b>Username dan Password tidak sesuai!</b>';
                    }
                } else {
                    $errormsg = '<b>User tidak aktif!</b>';
                }
            } else {
                $errormsg = '<b>User tidak ditemukan!</b>';
            }
        } else {
            $errormsg = '<b>Masukan username dan password!</b>';
        }
        echo $errormsg;
    }
?>
<div class="card cont-login">
    <div class="card-header">
        Login SI Portal berita
    </div>
    <div class="card-body">
        <form action="index.php?page=login" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="tombol-login">
            </div>
        </form>
    </div>
</div>