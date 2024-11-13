<?php
    $_userid = isset($_SESSION["id_user"]) ? $_SESSION["id_user"] : "";
    $_userrole = isset($_SESSION["role_user"]) ? $_SESSION["role_user"] : "";
    $sqlquery = "select b.*, u.nama_user from tbl_berita as b, tbl_user as u where b.user_berita = ". $_userid ." and b.user_berita = u.id_user";
    if ($_userrole == 'admin') {
        $sqlquery = "select b.*, u.nama_user from tbl_berita as b, tbl_user as u where b.user_berita = u.id_user";
    }
    $query = mysqli_query($_koneksi, $sqlquery);
?>
<div class="my-3">
    <a class="btn btn-primary" href="index.php?page=berita-add" role="button">Tambah Berita</a>
</div>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Penulis</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php 
        $no = 1;
        while($row = mysqli_fetch_array($query))
        {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><img src="files/<?php echo $row['img_berita']; ?>" width="100"/></td>
                <td><?php echo $row['judul_berita']; ?></td>
                <td><?php echo $row['kategori_berita']; ?></td>
                <td><?php echo $row['nama_user']; ?></td>
                <td><?php echo $row['tanggal_berita']; ?></td>
                <td><?php echo $row['status_berita']; ?></td>
                <td>
                    <a class="mr-2" href="index.php?page=berita-edit&id_berita=<?php echo $row['id_berita']; ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="index.php?page=berita-delete&id_berita=<?php echo $row['id_berita']; ?>">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>