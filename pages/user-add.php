<?php 
if(isset($_POST['tombol-simpan']))
{
    $role = isset($_POST['role']) ? $_POST['role'] : 'penulis';
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : 'pasif';

    if ($username !='' && $password != '') {
        $pass_enkripsi = md5($password);
        $sqlinsert = "INSERT INTO tbl_user (username, password, nama_user, role_user, status) VALUE ('$username', '$pass_enkripsi', '$nama', '$role', '$status')";
        if (mysqli_query($_koneksi, $sqlinsert)) {
            header('location:index.php?page=user');
        } else {
            echo "<b>Gagal insert database!</b>";
        }
    } else {
        echo "<b>Data tidak lengkap</b>";
    }
}
?>
<div class="card">
    <div class="card-header">
        Tambah Data User
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?page=user-add">
            <div class="form-group">
                <label>Role</label>
                <select class="form-control" name="role">
                    <option value="penulis">Penulis</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama"/>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password"/>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="aktif">Aktif</option>
                    <option value="pasif">Pasif</option>
                </select>
            </div>
            <div class="form-group">
                <a class="btn btn-danger mr-1" href="index.php?page=user" role="button">Back</a>
                <input type="submit" name="tombol-simpan" class="btn btn-primary" />
            </div>
        </form>
    </div>
</div>