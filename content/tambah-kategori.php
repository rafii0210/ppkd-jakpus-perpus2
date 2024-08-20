<?php

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($edit);
}
if (isset($_POST['simpan'])){
    // Jika param edit ada maka updet, selain itu maka tambah
    $id = isset($_GET['edit']) ? $_GET['edit'] : '';
    
    $nama_kategori = $_POST['nama_kategori'];
    $keterangan = $_POST['keterangan'];

    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO kategori (nama_kategori, keterangan) VALUES ('$nama_kategori','$keterangan')");
    } else {
        $update = mysqli_query($koneksi, "UPDATE kategori SET nama_kategori='$nama_kategori', keterangan = '$keterangan' WHERE id = '$id'");
    }
    header("location:?pg=kategori&tambah=berhasil");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM kategori Where id = '$id'");
    header("location:?pg=kategori&hapus=berhasil");
}

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Data Kategori</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama kategori</label>
                            <input type="text" value="<?php echo ($rowEdit['nama_kategori'] ?? '') ?>" class="form-control" name="nama_kategori">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">keterangan</label>
                            <input type="text" value="<?php echo ($rowEdit['keterangan'] ?? '') ?>" class="form-control" name="keterangan">
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" name="simpan" value="simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>