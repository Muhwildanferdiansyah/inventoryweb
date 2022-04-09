<!-- Begin Page Content -->
<div class="container-fluid">

    <form action="<?= base_url() ?>rop/proses_tambah" name="myForm" method="POST" enctype="multipart/form-data"
        onsubmit="return validateForm()">


        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="d-sm-flex">
                <a href="<?= base_url() ?>rop" class="btn btn-md btn-circle btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                </a>
                &nbsp;
                <h1 class="h2 mb-0 text-gray-800">Tambah Reorder Point</h1>
            </div>

            <button type="submit" class="btn btn-primary btn-md btn-icon-split">
                <span class="text text-white">Simpan Data</span>
                <span class="icon text-white-50">
                    <i class="fas fa-save"></i>
                </span>
            </button>

        </div>

        <div class="d-sm-flex  justify-content-between mb-0">
            <div class="col-lg-8 mb-4">
                <!-- form -->
                <div class="card border-bottom-secondary shadow mb-4">
                    <div class="card-header py-3 bg-secondary">
                        <h6 class="m-0 font-weight-bold text-white">Form Reorder Point</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">

                            <!-- Tgl Masuk -->
                            <div class="form-group"><label>Tanggal Masuk</label>
                                <input class="form-control" name="tgl" id="datepicker" value="<?= $tglnow ?>"
                                    type="text" placeholder="" autocomplete="off">
                            </div>

                            <!-- opsi barang -->
                            <div class="form-group"><label>Barang</label>
                                <select name="barang" class="form-control chosen">
                                    <option value="">--Pilih--</option>
                                    <?php foreach($barang as $b): ?>
                                    <option value="<?= $b->id_barang ?>"><?= $b->nama_barang ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <!-- Lead Time -->
                            <div class="form-group "><label>Lead Time(Satuan Hari)</label>
                                <input class="form-control lt" name="shari" id="shari" readonly type="text"
                                    placeholder="">
                            </div>


                            <!-- Pemakaian Maxiamal -->
                            <div class="form-group"><label>Pemakaian rata-rata</label>
                                <input class="form-control pmax" name="pmr" id="pmr" onkeyup="ambilBarang()" type="text"
                                    placeholder="">
                            </div>

                            <!-- pemakaian Minimal -->
                            <div class="form-group"><label>lead Time Demand (Lead Time * Pemakaian rata-rata)</label>
                                <input class="form-control pmin" name="ltd" id="ltd" readonly type="text"
                                    placeholder="">
                            </div>

                            <!-- Safety Stok -->
                            <div class="form-group"><label>Safety Stok</label>
                                <input class="form-control sstok" name="sstok" id="sstok" type="number" readonly
                                    placeholder="">

                            </div>

                            <div class="form-group"><label>Reorder Point (Lead Time Demand + Safety Stok)</label>
                                <input class="form-control rop" name="rop" id="rop" readonly type="text" placeholder="">
                            </div>

                        </div>


                        <br>
                    </div>
                </div>

            </div>


        </div>


    </form>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/rop1.js"></script>
<script src="<?= base_url(); ?>assets/js/validasi/formbarangmasuk.js"></script>
<script src="<?= base_url(); ?>assets/plugin/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/plugin/chosen/chosen.jquery.min.js"></script>

<script>
$('#barang').on('change', (event) => {
    ambilbarang(event.target.value).then(barang => {
        $('#shari').val(barang.shari);
        $('#sstok').val(barang.sstok);
    });
});
async function ambilBarang(id) {
    let response = await fetch('rop/getBarang' + id)
    let data = await response.json();
    return $data;

}
</script>






<script>
$('.chosen').chosen({
    width: '100%',

});

$('#datepicker').datepicker({
    autoclose: true
});
</script>

<?php if($this->session->flashdata('Pesan')): ?>

<?php else: ?>
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