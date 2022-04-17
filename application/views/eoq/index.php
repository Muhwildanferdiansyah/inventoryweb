<?php
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 1 = tanggal
    // variabel pecahkan 0 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi EOQ</h1>
    </div>

    <div class="col-lg-12 mb-4" id="container">

        <!-- Illustrations -->
        <div class="card border-bottom-secondary shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="dtHorizontalExample" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Barang</th>
                                <th>Kebutuhan Barang</th>
                                <th>Biaya Pemesanan</th>
                                <th>Biaya Penyimpanan</th>
                                <th>Safety Stock</th>
                                <th>Reorder Point</th>
                                <th>EOQ</th>
                                <th>Frekuensi Pemesanan</th>
                                <th>Biaya Optimal</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php $no = 1;
                            foreach ($eoq as $e) : ?>
                                <tr>
                                    <td><?= $no++ ?>.</td>
                                    <td><?= $e->id_barang ?></td>
                                    <td><?= $e->jumlah ?></td>
                                    <td><?= $e->biaya_pemesanan ?></td>
                                    <td><?= $e->biaya_penyimpanan ?></td>
                                    <td><?= $e->safety_stok ?></td>
                                    <td><?= $e->rop ?></td>
                                    <td><?= $e->eoq                 =  round(sqrt(2 * $e->jumlah * $e->biaya_pemesanan / $e->biaya_penyimpanan)); ?></td>
                                    <td><?= $e->frekuensi_pemesanan = round($e->jumlah / $e->eoq); ?></td>
                                    <td><?= $e->biaya_optimal       = round($e->eoq * $e->biaya_penyimpanan / 2 + $e->frekuensi_pemesanan * $e->biaya_pemesanan / $e->eoq); ?></td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/barangMasuk.js"></script>

<?php if ($this->session->flashdata('Pesan')) : ?>
    <?= $this->session->flashdata('Pesan') ?>
<?php else : ?>
    <script>
        $(document).ready(function() {
            let timerInterval
            Swal.fire({
                title: 'Memuat...',
                timer: 1000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {

            })
        });
    </script>
<?php endif; ?>