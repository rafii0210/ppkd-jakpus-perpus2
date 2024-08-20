<?php

if (isset($_GET['detail'])) {
    // data peminjam
    $id = $_GET['detail'];
    $detail = mysqli_query($koneksi, "SELECT anggota.nama_lengkap as nama_anggota, peminjaman.*, user.nama_lengkap FROM peminjaman LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota LEFT JOIN user ON user.id = peminjaman.id_user WHERE peminjaman.id = '$id'");
    $rowDetail = mysqli_fetch_assoc($detail);

    // // menghitung durasi / lama pinjam
    // $tanggal_pinjam = $rowDetail['tgl_pinjam'];
    // $tanggal_kembali = $rowDetail['tgl_kembali'];

    // $date_pinjam = new DateTime($tanggal_pinjam);
    // $date_kembali = new DateTime($tanggal_kembali);
    // $interval = $date_pinjam->diff($date_kembali);

// echo "Durasi buku yang dipinjam selama " . $interval->days . "hari";

// data buku yang dipinjam
$queryDetail = mysqli_query($koneksi, "SELECT * FROM detail_peminjaman LEFT JOIN buku ON buku.id = detail_peminjaman.id_buku WHERE id_peminjaman ='$id'");
}
if (isset($_POST['simpan'])) {
    $id = isset($_GET['edit']) ? $_GET['edit'] : '';
    // $kode_transaksi = $_POST['kode_transaksi'];

    $id_peminjam = $_POST['id_peminjaman'];
    // $id_kategori = $_POST['id_kategori'];
    // $id_anggota = $_POST['id_anggota'];
    $id_user = $_POST['id_user'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $denda = $_POST['denda'];
    $terlambat = $_POST['terlambat'];


    // $insert = mysqli_query($koneksi, "INSERT INTO peminjaman (kode_transaksi, id_anggota, id_user, tgl_pinjam, tgl_kembali, status) VALUES ('$kode_transaksi','$id_anggota','$id_user','$tgl_pinjam','$tgl_kembali','1')");
    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO pengembalian (id_peminjam, tgl_pengembalian, terlambat, denda) VALUES ('$id_peminjam', '$tgl_kembali', '$terlambat', '$denda')");
        $update = mysqli_query($koneksi, "UPDATE peminjaman SET status = 2 WHERE id = '$id_peminjam' ");
        header("location:?pg=pengembalian");
    }

    // if ($insert) {
    //     $id_peminjam = mysqli_insert_id($koneksi);
    //     foreach ($id_kategori as $key => $value) {
    //         $id_kategori = $_POST['id_kategori'][$key];
    //         $id_buku = $_POST['id_buku'][$key];
    //         $insert = mysqli_query($koneksi, "INSERT INTO detail_peminjaman(id_peminjaman, id_buku, id_kategori) 
    //         VALUES ('$id_peminjam','$id_kategori','$id_buku')");
    //         header("location:?pg=peminjaman&tambah=berhasil");
    //     }
    // }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "UPDATE peminjaman SET deleted_at = 1 WHERE id = '$id'");
    header("location:?pg=peminjaman&hapus=berhasil");
}

$level = mysqli_query($koneksi, "SELECT * FROM level ORDER BY id DESC");


$queryKodeTrans = mysqli_query($koneksi, "SELECT max(id) as id_transaksi FROM peminjaman");
$rowKodeTrans = mysqli_fetch_assoc($queryKodeTrans);
$no_urut = $rowKodeTrans['id_transaksi'];
$no_urut++;

$kode_transaksi = "PJ" . date("dmy") . sprintf("%03s", $no_urut);

$queryAnggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id DESC");
$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id DESC");
$querypeminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status = 1 ORDER BY id DESC");

?>
<?php if (isset($_GET['detail'])): ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">Detail Transaksi Pengembalian</div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="form-label">Tanggal Kembali</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <?php echo date('D, d M Y', strtotime($rowDetail['tgl_kembali'])) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="form-label">Nama Petugas</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <?php echo $rowDetail['nama_lengkap'] ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label for="" class="form-label">Status</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <?php echo pilihStatus($rowDetail['status']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!-- Tabel -->
                            <div class="my-3">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori Buku</th>
                                        <th>Judul Buku</th>

                                    </tr>
                                    <?php
                                    $no = 1;
                                    while ($rowDetail = mysqli_fetch_assoc($queryDetail)) : ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $rowDetail['id_kategori']; ?></td>
                                            <td><?php echo $rowDetail['judul']; ?></td>
                                        </tr>
                                    <?php endwhile ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">Data Pengembalian</div>
                    <div class="card-body">
                        <form action="" method="post">

                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Tanggal Kembali</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="tgl_kembali" values="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Petugas</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="" value="<?= isset($_SESSION['NAMA_LENGKAP']) ? $_SESSION['NAMA_LENGKAP'] : '' ?>" readonly>
                                    <input type="hidden" class="form-control" name="id_user" value="<?= ($_SESSION['ID_USER'] ?? '') ?>">
                                </div>
                            </div>
                            <div class="mb-5 row">
                                <div class="col-sm-2">
                                    <label for="">Kode Peminjaman</label>
                                </div>
                                <div class="col-sm-3">
                                    <select name="id_peminjaman" id="kode_peminjaman" class="form-control">
                                        <option value="">Pilih kode peminjaman</option>
                                        <?php while ($rowpeminjaman = mysqli_fetch_assoc($querypeminjaman)) : ?>
                                            <option value="<?= $rowpeminjaman['id'] ?>"><?= $rowpeminjaman['kode_transaksi'] ?></option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row-mb-3">
                                <div class="col-sm-6">
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <label for="">Nama Anggota</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input placeholder="Nama Anggota" type="text" readonly id="nama_anggota" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <label for="">Tanggal Pinjam</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input placeholder="Tanggal Pinjam" type="text" readonly id="tgl_pinjam" name="tgl_pinjam" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <label for="">Tanggal Kembali</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" readonly id="tgl_kembali" name="tgl_kembali" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <label for="">Terlambat</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" readonly name="terlambat" id="terlambat" value="" class="form-control">
                                            <input type="hidden" id="denda" name="denda">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="row-mb-3">

                        <div class="row-mb-3">

                            <!-- Set Data kategori Buku dan Buku -->

                        </div>

                        <div class="mt-5 mb-5">
                            <table class="table table-bordered">
                                <!-- <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori Buku</th>
                                        <th>Judul Buku</th>
                                        <th>Tahun Terbit</th>
                                    </tr>
                                </thead>
                                <tbody> -->


                                </tbody>
                            </table>
                            <div align="right" class="total-denda">

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

    <?php endif ?>