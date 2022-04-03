function safety(){
    var nilai1  = $('input[name="pmax"]').val();
    var nilai2  = $('input[name="pmin"]').val();
    var nilai3   = $('input[name="shari"]').val();

    var hasil = (parseFloat(nilai1) - parseFloat(nilai2)) * parseFloat(nilai3);
    if(!isNaN(hasil)){
        $('input[name="sstok"]').val(hasil);
    } else {
        $('input[name="sstok"]').val(0);

    }



}