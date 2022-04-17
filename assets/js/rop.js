function ambilBarang() {
    var link = $('#baseurl').val();
    var base_url = link + 'rop/getBarang';
    var barang = $('[name="barang"]').val();

    if (barang == '') {
        $('input[name="shari"]').val(0);
        $('input[name="sstok"]').val(0);
    } else {
        $.ajax({
            type: 'POST',
            data: 'id=' + barang,
            url: base_url,
            dataType: 'json',
            success: function(hasil) {
                // $('#shari').val(hasil[0].lead_time);
                // $('#sstok').val(hasil[0].safety_stok);
                // getLeadTime(hasil[0].shari, hasil[0].id_barang);
                

            }
        });
    }


}
function getLeadTime(shari, id) {
    var link = $('#baseurl').val();
    var base_url = link + 'rop/getLeadTime';

    $.ajax({
        type: 'POST',
        data: {
            id: id
        },
        url: base_url,
        dataType: 'json',
        success: function(hasil) {
            console.log(hasil.total);
            $('#shari').text(parseInt(shari) + parseInt(hasil.total));
        }
    });

}

// hitung

function kali(){
    var nilai1  = $('input[name="shari"]').val();
    var nilai2  = $('input[name="pmr"]').val();
    var nilai3   = $('input[name="ltd"]').val();
    var nilai4   = $('input[name="sstok"]').val();

    var hasil = parseFloat(nilai1) * parseFloat(nilai2);
    if(!isNaN(hasil)){
        $('input[name="ltd"]').val(hasil);
    } else {
        $('input[name="ltd"]').val(0);
    }

    var hasil1 = parseFloat(nilai3) + parseFloat(nilai4);
    if(!isNaN(hasil1)){
        $('input[name="rop"]').val(hasil1);
    } else {
        $('input[name="rop"]').val(0);
    }


}