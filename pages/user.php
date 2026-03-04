<?php

$selectUser = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");
$rows = mysqli_fetch_all($selectUser, MYSQLI_ASSOC);
// mysqli_fetch_assoc($selectUser);

if (isset($_GET['idDel'])) {
    $idDel = $_GET['idDel'];
    $deleteUser = mysqli_query($koneksi, "DELETE FROM users WHERE id='$idDel'");
    if ($deleteUser) {
        header("location:?page=user");
    }
}
?>



<div class="card table-responsive">
    <div class="card-header">
        <div class="card-title">
            <h4>Data Pengguna</h4>
        </div>
    </div>
    <div class="card-body">
        <div align="right">
            <a href="?page=tambah-edit-user" class="btn btn-primary my-2">Buat Pengguna Baru</a>
        </div>
        <table class="table table-bordered text-center" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($rows as $value) {
                ?>

                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $value['email']; ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td>
                            <a href="?page=tambah-edit-user&id=<?php echo base64_encode($value['id']) ?>"
                                class="btn btn-success btn-sm rounded">Ubah</a>
                            <form action="?page=user&idDelete=<?php echo $value['id'] ?>" method="POST"
                                onclick="return confirm('Anda yakin untuk menghapusnya?')" class="d-inline">
                                <button class="btn btn-danger btn-sm rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>