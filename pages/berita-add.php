<?php 
if(isset($_POST['tombol-simpan']))
{
    $temp = $_FILES['gambar']['tmp_name'];
    $name = rand(0,9999).$_FILES['gambar']['name'];
    $size = $_FILES['gambar']['size'];
    $type = $_FILES['gambar']['type'];

    $judul = isset($_POST['judul']) ? $_POST['judul'] : '';
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : 'lainnya';
    $isi = isset($_POST['isi']) ? $_POST['isi'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : 'draf';
    $date = date('Y-m-d');
    $userberita = isset($_SESSION["id_user"]) ? $_SESSION["id_user"] : '';

    $folder = "files/";
    if ($size < 2048000 and ($type =='image/jpeg' or $type == 'image/png')) {
        $sqlinsert = "INSERT INTO tbl_berita (judul_berita, isi_berita, img_berita, kategori_berita, user_berita, tanggal_berita, status_berita) VALUE ('$judul', '$isi', '$name', '$kategori', '$userberita', '$date', '$status')";
        move_uploaded_file($temp, $folder . $name);
        mysqli_query($_koneksi, $sqlinsert);
        header('location:index.php?page=berita');
    }else{
        echo "<b>Gagal Upload File</b>";
    }
}
?>
<div class="card">
    <div class="card-header">
        Tambah Data Berita
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?page=berita-add" enctype="multipart/form-data">
            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control" name="kategori">
                    <option value="politik">Politik</option>
                    <option value="olahraga">Olahraga</option>
                    <option value="pendidikan">Pendidikan</option>
                    <option value="kuliner">Kuliner</option>
                    <option value="hiburan">Hiburan</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
            <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="judul"/>
            </div>
            <div class="form-group">
                <label>Isi Berita</label>
                <textarea class="form-control" name="isi"></textarea>
            </div>
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" class="form-control" name="gambar"/>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="draf">Draf</option>
                    <option value="publish">Publish</option>
                </select>
            </div>
            <div class="form-group">
                <a class="btn btn-danger mr-1" href="index.php?page=berita" role="button">Back</a>
                <input type="submit" name="tombol-simpan" class="btn btn-primary" />
            </div>
        </form>
    </div>
</div>