<?php
$querylevel = mysqli_query($koneksi, "SELECT * FROM level ORDER BY id DESC");
// $rowlevel = mysqli_fetch_assoc($querylevel);
// die;
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Data Level</div>
                <div class="card-body">
                    <div align="right" class="mb-3">
                        <a href="?pg=tambah-level" class="btn btn-primary">Tambah</a>
                    </div>
                    <?php if(isset($_GET['tambah'])) : ?>
                    <div class="alert alert-success">
                        Data berhasil ditambah
                    </div>
                    <?php endif ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Level</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            while ($rowlevel = mysqli_fetch_assoc($querylevel)) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowlevel['nama_level'] ?></td>
                                    <td><?php echo $rowlevel['keterangan'] ?></td>
                                    <td>
                                        <a href="?pg=tambah-level&edit=<?php echo $rowlevel['id'] ?>" class="btn btn-sm btn-success">Edit</a> | 
                                        
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini')" href="? pg=tambah-level&delete=<?php echo $rowlevel['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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