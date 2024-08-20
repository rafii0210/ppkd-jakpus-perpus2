<?php
$querykategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id DESC");
// $rowkategori = mysqli_fetch_assoc($querykategori);
// die;
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Data Kategori</div>
                <div class="card-body">
                    <div align="right" class="mb-3">
                        <a href="?pg=tambah-kategori" class="btn btn-primary">Tambah</a>
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
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            while ($rowkategori = mysqli_fetch_assoc($querykategori)) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowkategori['nama_kategori'] ?></td>
                                    <td><?php echo $rowkategori['keterangan'] ?></td>
                                    <td>
                                        <a href="?pg=tambah-kategori&edit=<?php echo $rowkategori['id'] ?>" class="btn btn-sm btn-success">Edit</a> | 
                                        
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini')" href="? pg=tambah-kategori&delete=<?php echo $rowkategori['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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