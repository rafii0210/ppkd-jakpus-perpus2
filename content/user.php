<?php
$queryUser = mysqli_query($koneksi, "SELECT level.nama_level, user.* FROM user LEFT JOIN level on level.id = user.id_level ORDER BY id DESC");
// $rowUser = mysqli_fetch_assoc($queryUser);
// die;
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Data User</div>
                <div class="card-body">
                    <div align="right" class="mb-3">
                        <a href="?pg=tambah-user" class="btn btn-primary">Tambah</a>
                    </div>
                    <?php if(isset($_GET['tambah'])) : ?>
                    <div class="alert alert-success">
                        Data berhasil ditambah
                    </div>
                    <?php endif ?>

                    <?php if(isset($_GET['edit'])) : ?>
                    <div class="alert alert-success">
                        Data berhasil diedit
                    </div>
                    <?php endif ?>

                    <?php if(isset($_GET['hapus'])) : ?>
                    <div class="alert alert-success">
                        Data berhasil dihapus
                    </div>
                    <?php endif ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Level</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            while ($rowUser = mysqli_fetch_assoc($queryUser)) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowUser['nama_level'] ?></td>
                                    <td><?php echo $rowUser['nama_lengkap'] ?></td>
                                    <td><?php echo $rowUser['email'] ?></td>
                                    <td>
                                        <a href="?pg=tambah-user&edit=<?php echo $rowUser['id'] ?>" class="btn btn-sm btn-success">Edit</a> | 
                                        
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini')" href="? pg=tambah-user&delete=<?php echo $rowUser['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>