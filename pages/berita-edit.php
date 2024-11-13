<?php
// get data
$id_berita = isset($_REQUEST['id_berita']) ? $_REQUEST['id_berita'] : '';
$ermsg_pas = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';
$dataedit = array();
if ($id_berita != '') {
    $_userid = isset($_SESSION["id_user"]) ? $_SESSION["id_user"] : "";
    $_userrole = isset($_SESSION["role_user"]) ? $_SESSION["role_user"] : "";
    $sqlcheck = "SELECT * FROM tbl_berita WHERE id_berita = $id_berita and user_berita = $_userid";
    if ($_userrole == 'admin') {
        $sqlcheck = "SELECT * FROM tbl_berita WHERE id_berita = $id_berita";
    }
    $qrycheck = mysqli_query($_koneksi, $sqlcheck);
    $dataedit = $qrycheck->fetch_array();

    // action edit
    if(isset($_POST['tombol-edit'])) {
        if ($dataedit && count($dataedit) > 0) {
            // data berita
            $judul = isset($_POST['judul']) ? $_POST['judul'] : $dataedit['judul_berita'];
            $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : $dataedit['kategori_berita'];
            $isi = isset($_POST['isi']) ? $_POST['isi'] : $dataedit['isi_berita'];
            $status = isset($_POST['status']) ? $_POST['status'] : $dataedit['status_berita'];
            $date = date('Y-m-d');
            $userberita = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 1;
            // data file
            $editfile = 0;
            if (isset($_FILES['gambar']['name']) && $_FILES['gambar']['name'] != '') {
                $temp = $_FILES['gambar']['tmp_name'];
                $name = rand(0,9999).$_FILES['gambar']['name'];
                $size = $_FILES['gambar']['size'];
                $type = $_FILES['gambar']['type'];
                $editfile = 1;
            }
            $folder = "files/";
            // action
            $sqlupdate = "UPDATE tbl_berita  SET judul_berita = '$judul', isi_berita = '$isi', kategori_berita = '$kategori', user_berita = '$userberita', tanggal_berita = '$date', status_berita = '$status' WHERE id_berita = $id_berita";
            if ($editfile == 1) {
                if ($size < 2048000 and ($type =='image/jpeg' or $type == 'image/png')) {
                    move_uploaded_file($temp, $folder . $name);
                    $sqlupdate = "UPDATE tbl_berita  SET judul_berita = '$judul', isi_berita = '$isi', img_berita = '$name', kategori_berita = '$kategori', user_berita = '$userberita', tanggal_berita = '$date', status_berita = '$status' WHERE id_berita = $id_berita";
                    mysqli_query($_koneksi, $sqlupdate);
                    $ermsg = 'Data berhasil di update!';
                } else {
                    mysqli_query($_koneksi, $sqlupdate);
                    $ermsg = 'Sukses update!, tetapi Gagal Upload File, Max 2MB, Format JPG/JPEG/PNG';
                }
            }else{
                mysqli_query($_koneksi, $sqlupdate);
                $ermsg = 'Data berhasil di update!';
            }
            $redirect = 'index.php?page=berita-edit&msg='.$ermsg.'&id_berita='.$dataedit['id_berita'];
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
            <form method="POST" action="index.php?page=berita-edit" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="kategori">
                        <option value="<?php echo $dataedit['kategori_berita'];?>"><?php echo $dataedit['kategori_berita'];?></option>
                        <option value="politik">Politik</option>
                        <option value="olehraga">Olahraga</option>
                        <option value="pendidikan">Pendidikan</option>
                        <option value="kuliner">Kuliner</option>
                        <option value="hiburan">Hiburan</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="judul" value="<?php echo $dataedit['judul_berita'];?>"/>
                </div>
                <div class="form-group">
                    <label>Isi Berita</label>
                    <textarea class="form-control" name="isi"><?php echo $dataedit['isi_berita'];?></textarea>
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <div class="mb-3">
                        <img src="files/<?php echo $dataedit['img_berita']; ?>" width="300"/>
                    </div>
                    <input type="file" class="form-control" name="gambar"/>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="<?php echo $dataedit['status_berita'];?>"><?php echo $dataedit['status_berita'];?></option>
                        <option value="draf">Draf</option>
                        <option value="publish">Publish</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id_berita" value="<?php echo $dataedit['id_berita'];?>"/>
                    <a class="btn btn-danger mr-1" href="index.php?page=berita" role="button">Back</a>
                    <input type="submit" name="tombol-edit" class="btn btn-primary" />
                </div>
            </form>
        <?php } else { ?>
            <div class="alert alert-warning" role="alert">
                Data tidak ditemukan!
            </div>
            <div>
                <a class="btn btn-danger mr-1" href="index.php?page=berita" role="button">Back</a>
            </div>
        <?php } ?>
    </div>
</div>