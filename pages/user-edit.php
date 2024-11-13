<?php
// get data
$id_user = isset($_REQUEST['id_user']) ? $_REQUEST['id_user'] : '';
$ermsg_pas = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';
$dataedit = array();
if ($id_user != '') {
    $sqlcheck = "SELECT * FROM tbl_user WHERE id_user = $id_user";
    $qrycheck = mysqli_query($_koneksi, $sqlcheck);
    $dataedit = $qrycheck->fetch_array();

    // action edit
    if(isset($_POST['tombol-edit'])) {
        if (count($dataedit) > 0) {
            // data berita
            $role = isset($_POST['role']) ? $_POST['role'] : $dataedit['role_user'];
            $nama = isset($_POST['nama']) ? $_POST['nama'] : $dataedit['nama_user'];
            $status = isset($_POST['status']) ? $_POST['status'] : $dataedit['status'];
            if ($nama != '') {
                // action
                $sqlupdate = "UPDATE tbl_user  SET nama_user = '$nama', role_user = '$role', status = '$status' WHERE id_user = $id_user";
                if (mysqli_query($_koneksi, $sqlupdate)) {
                    $ermsg = 'Data berhasil di update!';
                } else {
                    $ermsg = 'Data gagal di update!';
                }
            } else {
                $ermsg = 'Nama harus diisi!';
            }
            $redirect = 'index.php?page=user-edit&msg='.$ermsg.'&id_user='.$dataedit['id_user'];
            header('location:'.$redirect);
        }
    }
}
?>
<div class="card">
    <div class="card-header">
        Edit Data Berita
    </div>
    <div class="card-body">
        <?php if ($ermsg_pas != '') { ?>
            <div class="alert alert-info" role="alert">
                <?php echo $ermsg_pas;?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <?php if (count($dataedit) > 0) { ?>
            <form method="POST" action="index.php?page=user-edit">
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role">
                        <option value="<?php echo $dataedit['role_user'];?>"><?php echo $dataedit['role_user'];?></option>
                        <option value="penulis">Penulis</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $dataedit['nama_user'];?>"/>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="<?php echo $dataedit['status'];?>"><?php echo $dataedit['status'];?></option>
                        <option value="aktif">Aktif</option>
                        <option value="pasif">Pasif</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id_user" value="<?php echo $dataedit['id_user'];?>"/>
                    <a class="btn btn-danger mr-1" href="index.php?page=user" role="button">Back</a>
                    <input type="submit" name="tombol-edit" class="btn btn-primary" />
                </div>
            </form>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                Data tidak ditemukan!
            </div>
            <div>
                <a class="btn btn-danger mr-1" href="index.php?page=user" role="button">Back</a>
            </div>
        <?php } ?>
    </div>
</div>