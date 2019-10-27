$(function () {
    $('.daftar').on('click', function () {

        const id = $(this).data2('id');

        $.ajax({
            url: "http://localhost/antrian/pages/pasien.php",
            data2: {
                id: id
            },
            method: "post",
            dataType: "json",
            success: function (data2) {
                $('#nomor').val(data2.no_bpjs);
                $('#nama').val(data2.name);
            }
        });

    });
});