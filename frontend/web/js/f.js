//FUNCTION BUTTON SUBMIT
function insertPilihan(controller) {
    //MENGAMBIL VALUE NID/NIM DARI CHECKBOX YANG DIPILIH
    // var current = '<?= Yii::$app->controller->id; ?>';
    var currentController = controller;
    var val = $('input[type=checkbox]:checked').map(function (_, el) {
        var val = $(el).val();
        return val;
    }).get();

    //POP UP SAAT USER MEMILIH < 3 PILIHAN
    if ($('input[type=checkbox]:checked').length < 3) {
        Swal.fire({
            title: 'Wajib Memberikan 3 Pilihan!',
            icon: 'error',
            confirmButtonText: 'OK'
        })
    } else {
        //POP UP SAAT PILIHAN == 3
        Swal.fire({
            title: 'Simpan Pilihan?',
            icon: 'question',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1cc88a',
            cancelButtonColor: '#808080',
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function () {
                    $.ajax({
                        url: 'http://localhost/ta/frontend/web/site/insert',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            datas: val,
                            controller: currentController
                        }
                    })
                        .done(function (response) {
                            if (response.code == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.response_message,
                                    confirmButtonColor: '#1cc88a',
                                }).then(function () {
                                    window.location.href = '<?= BaseUrl::base(); ?>';
                                });
                            }
                            else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.response_message,
                                    confirmButtonColor: '#1cc88a',
                                }).then(function () {
                                    window.location.href = '<?= BaseUrl::base(); ?>';
                                });
                            }
                        })
                        .fail(function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.response_message,
                                confirmButtonColor: '#1cc88a',
                            }).then(function () {
                                window.location.href = '<?= BaseUrl::base(); ?>';
                            });
                        });
                });
            },
            allowOutsideClick: false
        });
    }
}

//POP UP SAAT USER INGIN MEMILIH LEBIH DARI 3 PILIHAN
$('input[type=checkbox]').on('change', function (e) {
    if ($('input[type=checkbox]:checked').length > 3) {
        $(this).prop('checked', false);
        Swal.fire({
            title: 'Maksimal Memilih 3!',
            icon: 'warning',
            confirmButtonText: 'OK'
        })
    }
});