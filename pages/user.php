<?php 
    $query = mysqli_query($_koneksi,"select * from tbl_user");
?>
<div class="my-3">
    <a class="btn btn-primary" href="index.php?page=user-add" role="button">Tambah User</a>
</div>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Role</th>
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
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['nama_user']; ?></td>
                <td><?php echo $row['role_user']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <a class="mr-2" href="index.php?page=user-edit&id_user=<?php echo $row['id_user']; ?>">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="index.php?page=user-delete&id_user=<?php echo $row['id_user']; ?>">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>