<?php
$querybuku = mysqli_query($koneksi, "SELECT kategori.nama_kategori, buku.* FROM buku LEFT JOIN kategori on kategori.id = buku.id_kategori ORDER BY id DESC");
// $rowbuku = mysqli_fetch_assoc($querybuku);
// die;
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Data Buku</div>
                <div class="card-body">
                    <div align="right" class="mb-3">
                        <a href="?pg=tambah-buku" class="btn btn-primary">Tambah</a>
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
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Jumlah</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Penulis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            while ($rowbuku = mysqli_fetch_assoc($querybuku)) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowbuku['nama_kategori'] ?></td>
                                    <td><?php echo $rowbuku['judul'] ?></td>
                                    <td><?php echo $rowbuku['jumlah'] ?></td>
                                    <td><?php echo $rowbuku['penerbit'] ?></td>
                                    <td><?php echo $rowbuku['tahun_terbit'] ?></td>
                                    <td><?php echo $rowbuku['penulis'] ?></td>
                                    <td>
                                        <a href="?pg=tambah-buku&edit=<?php echo $rowbuku['id'] ?>" class="btn btn-sm btn-success">Edit</a> | 
                                        
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini')" href="? pg=tambah-buku&delete=<?php echo $rowbuku['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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