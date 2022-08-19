<?php

use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Pilih Dosen Terpopuler';
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
<div class="dosen-index">

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
            <button id="insert-pilihan" class="btn btn-success" onclick="insertPilihan('dosen')">Simpan</button>
        </div>
    </div>
    <div id="circle-div2">
        <div class="row">
            <div id="jumlah-pilihan" class="btn btn-secondary" onclick="checkPilihan()" disabled>Jumlah Pilihan : 0</div>
        </div>
    </div>
    <!-- <div class="row justify-content-center mb-2">
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
    </div> -->

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

    <!-- Dosens -->
    <?php
    for ($i = 0; $i < count($akuntansi); $i++) {
        echo $akuntansi[$i];
        // echo $manajemen[$i];
        // echo $dkv[$i];
        // echo $ilkom[$i];
        // echo $psikologi[$i];
        // echo $arsitektur[$i];
        // echo $informatika[$i];
        // echo $si[$i];
        // echo $industri[$i];
        // echo $sipil[$i];
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
        $('.dosen').DataTable({
            "lengthChange": false,
            "pageLength": 10,
            "columnDefs": [{
                "targets": [0, 1, 3, 4],
                "className": "text-center",
            }],
        });
    });

    //FUNCTION BUTTON SUBMIT
    function insertPilihan() {
        //MENGAMBIL VALUE NID DARI CHECKBOX YANG DIPILIH
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
                                        timer: 4000
                                    }).then(function() {
                                        window.location.reload();
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

    $("#feb").click(function() {
        $(this).addClass('active');
        $(".feb").show();

        $("#fik").removeClass('active');
        $("#fp").removeClass('active');
        $("#ft").removeClass('active');

        $("#akuntansi").show();
        $("#manajemen").show();

        $("#dkv").hide();
        $("#ilkom").hide();
        $("#psikologi").hide();
        $("#informatika").hide();
        $("#arsitektur").hide();
        $("#si").hide();
        $("#industri").hide();
        $("#sipil").hide();

        // $("#dosen-dkv").hide();
        // $("#dosen-ilkom").hide();
        // $("#dosen-psikologi").hide();
        // $("#dosen-informatika").hide();
        // $("#dosen-arsitektur").hide();
        // $("#dosen-si").hide();
        // $("#dosen-industri").hide();
        // $("#dosen-sipil").hide();
    });

    $("#fik").click(function() {

        $(this).addClass('active');
        $(".fik").show();

        $("#feb").removeClass('active');
        $("#fp").removeClass('active');
        $("#ft").removeClass('active');

        $("#dkv").show();
        $("#ilkom").show();

        $("#akuntansi").hide();
        $("#manajemen").hide();
        $("#psikologi").hide();
        $("#informatika").hide();
        $("#arsitektur").hide();
        $("#si").hide();
        $("#industri").hide();
        $("#sipil").hide();

        $("#dosen-akuntansi").hide();
        $("#dosen-manajemen").hide();
        $("#dosen-psikologi").hide();
        $("#dosen-informatika").hide();
        $("#dosen-arsitektur").hide();
        $("#dosen-si").hide();
        $("#dosen-industri").hide();
        $("#dosen-sipil").hide();
    });

    $("#fp").click(function() {
        $(this).addClass('active');
        $(".fp").show();

        $("#feb").removeClass('active');
        $("#fik").removeClass('active');
        $("#ft").removeClass('active');

        $("#psikologi").show();

        $("#dkv").hide();
        $("#ilkom").hide();
        $("#akuntansi").hide();
        $("#manajemen").hide();
        $("#informatika").hide();
        $("#arsitektur").hide();
        $("#si").hide();
        $("#industri").hide();
        $("#sipil").hide();

        $("#dosen-dkv").hide();
        $("#dosen-ilkom").hide();
        $("#dosen-akuntansi").hide();
        $("#dosen-manajemen").hide();
        $("#dosen-informatika").hide();
        $("#dosen-arsitektur").hide();
        $("#dosen-si").hide();
        $("#dosen-industri").hide();
        $("#dosen-sipil").hide();
    });

    $("#ft").click(function() {
        $(this).addClass('active');
        $(".ft").show();

        $("#feb").removeClass('active');
        $("#fp").removeClass('active');
        $("#fik").removeClass('active');

        $("#informatika").show();
        $("#arsitektur").show();
        $("#si").show();
        $("#industri").show();
        $("#sipil").show();

        $("#dkv").hide();
        $("#ilkom").hide();
        $("#akuntansi").hide();
        $("#manajemen").hide();
        $("#psikologi").hide();

        $("#dosen-dkv").hide();
        $("#dosen-ilkom").hide();
        $("#dosen-akuntansi").hide();
        $("#dosen-manajemen").hide();
        $("#dosen-psikologi").hide();
    });

    function toggle(id) {
        var table = '#dosen-' + id;
        $(table).toggle();
        // alert(table);
    }
    // var chart = new CanvasJS.Chart("chartContainer", {
    //     title: {
    //         text: "Analysis"
    //     },
    //     axisY: {
    //         title: "Variables"
    //     },
    //     data: [{
    //         type: "line",
    //         dataPoints: data
    //     }]
    // });
    // chart.render();

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
                    url: '<?= BaseUrl::base(); ?>/dosen/check',
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

    //UPDATE JUMLAH PILIHAN YANG TELAH DIPILIH
    $('input[type=checkbox]').on('change', function(e) {
        var pilihan = $('input[type=checkbox]:checked').length;
        $('#jumlah-pilihan').text('Jumlah Pilihan : ' + pilihan);

        if (pilihan == 3) {
            $('#jumlah-pilihan').text('Check Pilihan');
        }
    });
</script>