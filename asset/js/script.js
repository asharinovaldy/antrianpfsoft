$(function () {
    $('.daftar').on('click', function () {

        const id = $(this).data('id');

        $.ajax({
            url: "http://localhost/antrian/pages/antri.php",
            data: {
                id: id
            },
            method: "post",
            dataType: "json",
            success: function (data) {
                $('#poli').val(data.Nama);
                $('#id').val(data.No_Con);
            }
        });
    });
});

$(document).ready(function () {
    $("#bpjs").change(function () {
        $("#pesan").html("Cek Username ...");
        var bpjs = $("#bpjs").val();


        $.ajax({
            type: "POST",
            url: "http://localhost/antrian/pages/validasi.php",
            data: "bpjs=" + bpjs,
            success: function (data) {
                if (data == 0) {
                    $("#pesan").html("Username belum terdaftar, Silahkan mendaftar di Admin rumah sakit!");
                    $("#bpjs").css('border', '30px #090 solid');
                }
            }
        });

    });
});