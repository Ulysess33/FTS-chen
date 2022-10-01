$(document).ready(function () {

    function getUkuran() {
        var model = $('#model-barang').val();
        $.get("http://localhost/aplikasi/index.php/hasilpredik/get_ukuran/" + model, function (data) {
            // $( ".result" ).html( data );
            alert(data);
            // alert( "Load was performed." );
        });
    }
    // var modelBarang = document.getElementById('model-barang');
    // var ukuran = document.getElementById('ukuran');
    // var tgl = document.getElementById('tgl');
    // var penjualan = document.getElementById('penjualan');


    // //jika dropdown model barang di isi
    // modelBarang.addEventListener('input', () => {

    //     // panggil dengan ajax
    //     $.ajax({
    //         url: "http://localhost/aplikasi/index.php/prediksi/get_ukuran/" + modelBarang.value,
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function (res) {

    //             for (var key in res) {
    //                 opt = document.createElement('option');
    //                 opt.innerHTML = res[key];
    //                 opt.setAttribute('value', res[key]);
    //                 ukuran.append(opt);
    //             };

    //         }
    //     });

    // });

    // //jika dropdown tgl di isi
    // tgl.addEventListener('input', () => {

    //     // panggil dengan ajax
    //     $.ajax({
    //         url: "http://localhost/aplikasi/index.php/prediksi/get_penjualan/" + modelBarang.value + '/' + ukuran.value + '/' + tgl.value,
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function (res) {
    //             penjualan.value = res;
    //         }
    //     });

    // });



});
