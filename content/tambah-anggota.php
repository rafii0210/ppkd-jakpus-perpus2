<?php

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($edit);
}
if (isset($_POST['simpan'])){
    // Jika param edit ada maka updet, selain itu maka tambah
    $id = isset($_GET['edit']) ? $_GET['edit'] : '';
    
    $nisn = $_POST['nisn'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_tlp = $_POST['no_tlp'];
    $alamat = $_POST['alamat'];
    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO anggota (nisn, nama_lengkap, jenis_kelamin, no_tlp,alamat) VALUES ('$nisn','$nama_lengkap','$jenis_kelamin','$no_tlp','$alamat')");
     header("location:?pg=anggota&tambah=berhasil");
    } else {
        $update = mysqli_query($koneksi, "UPDATE anggota SET nisn = '$nisn', nama_lengkap = '$nama_lengkap', jenis_kelamin = '$jenis_kelamin', no_tlp= '$no_tlp', alamat = '$alamat' WHERE id = '$id' ");
        header("location:?pg=anggota&edit=berhasil");
    }
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM anggota Where id = '$id'");
    header("location:?pg=anggota&hapus=berhasil");
}
$anggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id DESC");

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Anggota</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Nisn</label>
                            <input type="text" value="<?php echo ($rowEdit['nisn'] ?? '') ?>" class="form-control" name="nisn">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Lengkap</label>
                            <input type="text" value="<?php echo ($rowEdit['nama_lengkap'] ?? '') ?>" class="form-control" name="nama_lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="" class="form-control">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki">laki-laki</option>
                            <option value="perempuan">perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">No Tlp</label>
                            <input type="text" value="<?php echo ($rowEdit['no_tlp'] ?? '') ?>" class="form-control" name="no_tlp">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Alamat</label>
                            <input type="text" value="<?php echo ($rowEdit['alamat'] ?? '') ?>" class="form-control" name="alamat">
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