$(document).ready(function() {
    $('#dtHorizontalExample').DataTable({
        "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');

    ambilpemesanan()


});

function ambilpemesanan() {
    var link = $('#baseurl').val();
    var base_url = link + 'pemesananMasuk/getpemesanan';
    var pemesanan = $('[name="pemesanan"]').val();

    if (pemesanan == '') {
        $('#preview').attr("src", link + "assets/upload/pemesanan/box.png");
        $('#judul').text("-");
        $('#stok').text("-");
    } else {
        $.ajax({
            type: 'POST',
            data: 'id=' + pemesanan,
            url: base_url,
            dataType: 'json',
            success: function(hasil) {
                $('#preview').attr("src", link + "assets/upload/pemesanan/" + hasil[0].foto);
                $('#judul').text(hasil[0].nama_pemesanan);
                getTotalStok(hasil[0].stok, hasil[0].id_pemesanan);
            }
        });
    }


}

function getTotalStok(stok, id) {
    var link = $('#baseurl').val();
    var base_url = link + 'pemesananMasuk/getTotalStok';

    $.ajax({
        type: 'POST',
        data: {
            id: id
        },
        url: base_url,
        dataType: 'json',
        success: function(hasil) {
            console.log(hasil.total);
            $('#stok').text(parseInt(stok) + parseInt(hasil.total));
        }
    });

}



function detail(id) {
    var base_url = $('#baseurl').val();
    window.location.href = base_url + "pemesanan/detail_data/" + id;

}

function konfirmasi(id, jumlah, idb) {
    var base_url = $('#baseurl').val();

    swal.fire({
        title: "Hapus Data ini?",
        icon: "warning",
        closeOnClickOutside: false,
        showCancelButton: true,
        confirmButtonText: 'Iya',
        confirmButtonColor: '#4e73df',
        cancelButtonText: 'Batal',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: "Memuat...",
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
                timer: 1000,
                showConfirmButton: false,
            }).then(
                function() {
                    window.location.href = base_url + "pemesananMasuk/proses_hapus/" + id + '/' + jml + '/' + idb;
                }
            );
        }
    });

}