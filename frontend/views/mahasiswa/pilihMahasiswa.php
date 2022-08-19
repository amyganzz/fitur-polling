<?php

use yii\helpers\BaseUrl;
use yii\helpers\Html;

$this->title = 'Pilih Mahasiswa Terpopuler';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    #circle-div {
        display: flex;
        position: fixed;
        bottom: 25px;
        right: 40px;
    }

    #circle-div2 {
        display: flex;
        position: fixed;
        bottom: 70px;
        right: 40px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        border: none;
        background: none;
    }
</style>
<div class="mahasiswa-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <div class="row justify-content-center mb-3">
        <?php
        if (!(empty($message))) {
            echo '<btn id="message" style="display: none;">sudah</btn>';
        } else {
            echo '<btn id="message" style="display: none;"></btn>';
        }
        ?>
        <p id="wajib" class="text-danger mb-2">*Wajib Memberikan 3 Pilihan</p>
    </div>
    <div id="circle-div">
        <div class="row">
            <button id="insert-pilihan" class="btn btn-success" onclick="insertPilihan('mahasiswa')">Simpan</button>
        </div>
    </div>
    <div id="circle-div2">
        <div class="row">
            <div id="jumlah-pilihan" class="btn btn-secondary" onclick="checkPilihan()" disabled>Jumlah Pilihan : 0</div>
        </div>
    </div>
    <div class="row justify-content-center mb-2">
        <div class="dropdown">
            <btn id="pilihan-angkatan" style="display: none;"></btn>
            <a id="btn-angkatan" class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Angkatan
            </a>

            <div id="menu-angkatan" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a id="2015" class="dropdown-item angkatan" href="#">Angkatan 2015</a></li>
                <li><a id="2016" class="dropdown-item angkatan" href="#">Angkatan 2016</a></li>
                <li><a id="2017" class="dropdown-item angkatan" href="#">Angkatan 2017</a></li>
                <li><a id="2018" class="dropdown-item angkatan" href="#">Angkatan 2018</a></li>
                <li><a id="2019" class="dropdown-item angkatan" href="#">Angkatan 2019</a></li>
                <li><a id="2020" class="dropdown-item angkatan" href="#">Angkatan 2020</a></li>
                <li><a id="2021" class="dropdown-item angkatan" href="#">Angkatan 2021</a></li>
                <li><a id="2022" class="dropdown-item angkatan" href="#">Angkatan 2022</a></li>
            </div>
        </div>
    </div>

    <div class="row justify-content-center my-3">
        <div class="col-3">
            <a id="feb" class="my-3 btn btn-success btn-lg btn-block" onClick="toggle(this.id)">Fakultas<br>Ekonomi dan Bisnis</a>
        </div>
        <div class="col-3">
            <a id="fik" class="my-3 btn btn-success btn-lg btn-block" onClick="toggle(this.id)">Fakultas<br>Ilmu Komunikasi</a>
        </div>
        <div class="col-3">
            <a id="fp" class="my-3 btn btn-success btn-lg btn-block" onClick="toggle(this.id)">Fakultas<br>Psikologi</a>
        </div>
        <div class="col-3">
            <a id="ft" class="my-3 btn btn-success btn-lg btn-block" onClick="toggle(this.id)">Fakultas<br>Teknik</a>
        </div>
    </div>

    <!-- Mahasiswas -->
    <?php
    for ($i = 0; $i < count($akuntansi); $i++) {
        echo $akuntansi[$i];
        echo $manajemen[$i];
        echo $dkv[$i];
        echo $ilkom[$i];
        echo $psikologi[$i];
        echo $arsitektur[$i];
        echo $informatika[$i];
        echo $si[$i];
        echo $industri[$i];
        echo $sipil[$i];
    }
    ?>
</div>

<script>
    $(document).ready(function() {
        var message = $("#message").text();
        if (message == 'sudah') {
            $("#wajib").text('*<?php echo $message; ?>')
            $("#jumlah-pilihan").hide()
            $("#insert-pilihan").hide()
            $("input[type=checkbox]").attr("disabled", true);
        }
    });
    $(document).ready(function() {
        $('.mhs').DataTable({
            "lengthChange": false,
            "pageLength": 10,
            "columnDefs": [{
                "targets": [0, 1, 3, 4],
                "className": "text-center",
            }],
            // 'columnDefs': [
            //     // { className: "dt-head-center", targets: [ 0, 1, 2, 3, 4, 5, 6, 7 ] },
            //     // { className: "dt-body-right", targets: [ 3, 4, 5, 6, 7 ] }
            //     {
            //         "targets": 2,
            //         "width": "40px",
            //         // "padding": "0px",
            //         "className": "text-center",
            //     },
            // ]
            //     'columnDefs': [
            //         {
            // 			"targets": 1,
            // 			"width": "10%",
            // 			"className": "text-center",
            // 		}, 
            //         {
            // 			"targets": 3,
            // 			"width": "25%",
            // 			"className": "text-center",
            // 		}, 
            // ],
        });
    });

    $(document).ready(function() {
        $('#check').DataTable({
            "lengthChange": false,
            "pageLength": 10,
            "columnDefs": [{
                "targets": [0, 1, 3, 4],
                "className": "text-center",
            }],
        });
    });

    function pilihanAngkatan() {
        Swal.fire({
            icon: 'warning',
            title: 'Pilih Angkatan Terlebih Dahulu',
            showConfirmButton: false,
            timer: 1000
        })
    }

    $("#feb").click(function() {
        var angkatan = $("#pilihan-angkatan").text();
        if (angkatan == '') {
            pilihanAngkatan();
        }
        $(this).addClass('active');
        $(".feb-" + angkatan).show();

        $("#fik").removeClass('active');
        $("#fp").removeClass('active');
        $("#ft").removeClass('active');

        $("#akuntansi-" + angkatan).show();
        $("#manajemen-" + angkatan).show();

        $("#dkv-" + angkatan).hide();
        $("#ilkom-" + angkatan).hide();
        $("#psikologi-" + angkatan).hide();
        $("#informatika-" + angkatan).hide();
        $("#arsitektur-" + angkatan).hide();
        $("#si-" + angkatan).hide();
        $("#industri-" + angkatan).hide();
        $("#sipil-" + angkatan).hide();

        $("#mahasiswa-dkv-" + angkatan).hide();
        $("#mahasiswa-ilkom-" + angkatan).hide();
        $("#mahasiswa-psikologi-" + angkatan).hide();
        $("#mahasiswa-informatika-" + angkatan).hide();
        $("#mahasiswa-arsitektur-" + angkatan).hide();
        $("#mahasiswa-si-" + angkatan).hide();
        $("#mahasiswa-industri-" + angkatan).hide();
        $("#mahasiswa-sipil-" + angkatan).hide();
    });

    $("#fik").click(function() {
        var angkatan = $("#pilihan-angkatan").text();
        if (angkatan == '') {
            pilihanAngkatan();
        }

        $(this).addClass('active');
        $(".fik-" + angkatan).show();
        $(".feb").children().hide();
        $(".fp").children().hide();
        $(".ft").children().hide();

        $("#feb").removeClass('active');
        $("#fp").removeClass('active');
        $("#ft").removeClass('active');

        $("#dkv-" + angkatan).show();
        $("#ilkom-" + angkatan).show();

        $("#akuntansi-" + angkatan).hide();
        $("#manajemen-" + angkatan).hide();
        $("#psikologi-" + angkatan).hide();
        $("#informatika-" + angkatan).hide();
        $("#arsitektur-" + angkatan).hide();
        $("#si-" + angkatan).hide();
        $("#industri-" + angkatan).hide();
        $("#sipil-" + angkatan).hide();

        $("#mahasiswa-akuntansi-" + angkatan).hide();
        $("#mahasiswa-manajemen-" + angkatan).hide();
        $("#mahasiswa-psikologi-" + angkatan).hide();
        $("#mahasiswa-informatika-" + angkatan).hide();
        $("#mahasiswa-arsitektur-" + angkatan).hide();
        $("#mahasiswa-si-" + angkatan).hide();
        $("#mahasiswa-industri-" + angkatan).hide();
        $("#mahasiswa-sipil-" + angkatan).hide();
    });

    $("#fp").click(function() {
        var angkatan = $("#pilihan-angkatan").text();
        if (angkatan == '') {
            pilihanAngkatan();
        }

        $(this).addClass('active');
        $(".fp-" + angkatan).show();
        $(".feb").children().hide();
        $(".fik").children().hide();
        $(".ft").children().hide();

        $("#feb").removeClass('active');
        $("#fik").removeClass('active');
        $("#ft").removeClass('active');

        $("#psikologi-" + angkatan).show();

        $("#dkv-" + angkatan).hide();
        $("#ilkom-" + angkatan).hide();
        $("#akuntansi-" + angkatan).hide();
        $("#manajemen-" + angkatan).hide();
        $("#informatika-" + angkatan).hide();
        $("#arsitektur-" + angkatan).hide();
        $("#si-" + angkatan).hide();
        $("#industri-" + angkatan).hide();
        $("#sipil-" + angkatan).hide();

        $("#mahasiswa-dkv-" + angkatan).hide();
        $("#mahasiswa-ilkom-" + angkatan).hide();
        $("#mahasiswa-akuntansi-" + angkatan).hide();
        $("#mahasiswa-manajemen-" + angkatan).hide();
        $("#mahasiswa-informatika-" + angkatan).hide();
        $("#mahasiswa-arsitektur-" + angkatan).hide();
        $("#mahasiswa-si-" + angkatan).hide();
        $("#mahasiswa-industri-" + angkatan).hide();
        $("#mahasiswa-sipil-" + angkatan).hide();
    });

    $("#ft").click(function() {
        var angkatan = $("#pilihan-angkatan").text();
        if (angkatan == '') {
            pilihanAngkatan();
        }

        $(this).addClass('active');
        $(".ft-" + angkatan).show();
        $(".feb").children().hide();
        $(".fp").children().hide();
        $(".fik").children().hide();

        $("#feb").removeClass('active');
        $("#fik").removeClass('active');
        $("#fp").removeClass('active');

        $("#informatika-" + angkatan).show();
        $("#arsitektur-" + angkatan).show();
        $("#si-" + angkatan).show();
        $("#industri-" + angkatan).show();
        $("#sipil-" + angkatan).show();

        $("#psikologi-" + angkatan).hide();
        $("#dkv-" + angkatan).hide();
        $("#ilkom-" + angkatan).hide();
        $("#akuntansi-" + angkatan).hide();
        $("#manajemen-" + angkatan).hide();

        $("#mahasiswa-psikologi-" + angkatan).hide();
        $("#mahasiswa-dkv-" + angkatan).hide();
        $("#mahasiswa-ilkom-" + angkatan).hide();
        $("#mahasiswa-akuntansi-" + angkatan).hide();
        $("#mahasiswa-manajemen-" + angkatan).hide();

        // $("#psikologi-" + angkatan).children().hide(); 
        // $("#dkv-" + angkatan).children().hide(); 
        // $("#ilkom-" + angkatan).children().hide(); 
        // $("#akuntansi-" + angkatan).children().hide(); 
        // $("#manajemen-" + angkatan).children().hide(); 
    });

    $(function() {
        $("#menu-angkatan li a").click(function() {
            $("#ft").removeClass('active');
            $("#feb").removeClass('active');
            $("#fik").removeClass('active');
            $("#fp").removeClass('active');
            var pilihanSebelum = $("#pilihan-angkatan").text();

            $("#btn-angkatan").text($(this).text());
            $("#btn-angkatan").val($(this).text());
            var val = $(this).attr('id');
            $("#pilihan-angkatan").text(val);

            var angkatan = $("#pilihan-angkatan").text();

            $("#psikologi-" + angkatan).hide();
            $("#dkv-" + angkatan).hide();
            $("#ilkom-" + angkatan).hide();
            $("#akuntansi-" + angkatan).hide();
            $("#manajemen-" + angkatan).hide();
            $("#informatika-" + angkatan).hide();
            $("#arsitektur-" + angkatan).hide();
            $("#si-" + angkatan).hide();
            $("#industri-" + angkatan).hide();
            $("#sipil-" + angkatan).hide();

            $("#mahasiswa-psikologi-" + angkatan).hide();
            $("#mahasiswa-dkv-" + angkatan).hide();
            $("#mahasiswa-ilkom-" + angkatan).hide();
            $("#mahasiswa-akuntansi-" + angkatan).hide();
            $("#mahasiswa-manajemen-" + angkatan).hide();
            $("#mahasiswa-informatika-" + angkatan).hide();
            $("#mahasiswa-arsitektur-" + angkatan).hide();
            $("#mahasiswa-si-" + angkatan).hide();
            $("#mahasiswa-industri-" + angkatan).hide();
            $("#mahasiswa-sipil-" + angkatan).hide();

            $("#psikologi-" + pilihanSebelum).hide();
            $("#dkv-" + pilihanSebelum).hide();
            $("#ilkom-" + pilihanSebelum).hide();
            $("#akuntansi-" + pilihanSebelum).hide();
            $("#manajemen-" + pilihanSebelum).hide();
            $("#informatika-" + pilihanSebelum).hide();
            $("#arsitektur-" + pilihanSebelum).hide();
            $("#si-" + pilihanSebelum).hide();
            $("#industri-" + pilihanSebelum).hide();
            $("#sipil-" + pilihanSebelum).hide();

            $("#mahasiswa-psikologi-" + pilihanSebelum).hide();
            $("#mahasiswa-dkv-" + pilihanSebelum).hide();
            $("#mahasiswa-ilkom-" + pilihanSebelum).hide();
            $("#mahasiswa-akuntansi-" + pilihanSebelum).hide();
            $("#mahasiswa-manajemen-" + pilihanSebelum).hide();
            $("#mahasiswa-informatika-" + pilihanSebelum).hide();
            $("#mahasiswa-arsitektur-" + pilihanSebelum).hide();
            $("#mahasiswa-si-" + pilihanSebelum).hide();
            $("#mahasiswa-industri-" + pilihanSebelum).hide();
            $("#mahasiswa-sipil-" + pilihanSebelum).hide();
        });
    });

    //BUTTON GROUP FAKULTAS
    // $('.btn-group-fakultas').on('click', '.btn', function() {
    //     $(this).addClass('active').siblings().removeClass('active');
    //     var val = $(this).attr('id');
    //     $('#mhs-' + val).toggle();
    // });

    //FUNCTION TOGGLE UNTUK BUTTON PRODI
    function toggle(id) {
        var table = '#mahasiswa-' + id;
        $(table).toggle();
    }

    //FUNCTION BUTTON SUBMIT
    function insertPilihan() {
        //MENGAMBIL VALUE NIM DARI CHECKBOX YANG DIPILIH
        var currentController = '<?= Yii::$app->controller->id; ?>';
        var val = $('input[type=checkbox]:checked').map(function(_, el) {
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
                preConfirm: function() {
                    return new Promise(function() {
                        $.ajax({
                                url: '<?= BaseUrl::base(); ?>/site/insert',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    datas: val,
                                    controller: currentController,
                                    '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->getCsrfToken()?>'
                                }
                            })
                            .done(function(response) {
                                if (response.code == 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: response.response_message,
                                        confirmButtonColor: '#1cc88a',
                                    }).then(function() {
                                        window.location.href = '<?= BaseUrl::base(); ?>';
                                    });
                                } else if (response.code != 200) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: response.response_message,
                                        confirmButtonColor: '#1cc88a',
                                    });
                                }
                            });
                    });
                },
                allowOutsideClick: false
            });
        }
    }

    //POP UP SAAT USER INGIN MEMILIH LEBIH DARI 3 PILIHAN
    $('input[type=checkbox]').on('change', function(e) {
        if ($('input[type=checkbox]:checked').length > 3) {
            $(this).prop('checked', false);
            Swal.fire({
                title: 'Maksimal Memilih 3!',
                icon: 'warning',
                confirmButtonText: 'OK'
            })
        }
    });

    //UPDATE JUMLAH PILIHAN YANG TELAH DIPILIH
    $('input[type=checkbox]').on('change', function(e) {
        var pilihan = $('input[type=checkbox]:checked').length;
        $('#jumlah-pilihan').text('Jumlah Pilihan : ' + pilihan);

        if (pilihan == 3) {
            $('#jumlah-pilihan').text('Check Pilihan');
        }
    });

    //RESET PILIHAN
    // $('button').click(() => {
    //     $('input[type=checkbox]').prop('checked', false);
    // })

    //FUNCTION BUTTON CHECK PILIHAN
    function checkPilihan() {
        //MENGAMBIL VALUE NIM DARI CHECKBOX YANG DIPILIH

        var val = $('input[type=checkbox]:checked').map(function(_, el) {
            var val = $(el).val();
            return val;
        }).get();

        if (val == '') {
            Swal.fire({
                title: 'Belum Ada Pilihan',
                icon: 'warning',
                showConfirmButton: false,
                timer: 1000
            })
        } else {


            $.ajax({
                    url: '<?= BaseUrl::base(); ?>/mahasiswa/check',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        datas: val,
                        '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->getCsrfToken()?>'
                    }
                })
                .done(function(response) {
                    Swal.fire({
                        title: 'Pilihan Saat Ini',
                        width: '1000px',
                        html: response.data,
                        confirmButtonColor: '#df4759',
                        showCancelButton: true,
                        cancelButtonText: 'Kembali',
                        confirmButtonText: 'Reset Pilihan',
                        preConfirm: function() {
                            $('input[type=checkbox]').prop('checked', false);
                            var pilihan = $('input[type=checkbox]:checked').length;
                            $('#jumlah-pilihan').text('Jumlah Pilihan : ' + pilihan);
                        },
                    });
                });
        }
    }
</script>