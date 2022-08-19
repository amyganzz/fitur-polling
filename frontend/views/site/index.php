<?php

/** @var yii\web\View $this */

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use app\models\Mahasiswa;
use app\models\Dosen;
use yii\helpers\Url;

$this->title = 'Polling Dosen dan Mahasiswa';
// var_dump($dataMahasiswaUniversitas); die();
?>

<style>
    /* .toggle.ios,
    .toggle-on.ios,
    .toggle-off.ios {
        border-radius: 20rem;
    }

    .toggle.ios .toggle-handle {
        border-radius: 20rem;
    } */

    .success {
        background: rgb(33, 136, 56, 0.2) !important;
    }

    .arrow {
        border: solid white;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 3px;
    }

    .up {
        transform: rotate(-135deg);
        -webkit-transform: rotate(-135deg);
    }

    table.dataTable td {
        font-size: 12pt;
        /* font-weight: bold; */
    }

    .card {
        background: rgb(147, 202, 237, 0.2);
        /* background: linear-gradient(180deg, rgba(0, 168, 255, 1) 19%, rgba(2, 221, 226, 1) 80%); */
    }


    .float {
        display: flex;
        position: fixed;
        bottom: 25px;
    }

    #circle-div2 {
        display: flex;
        position: fixed;
        bottom: 10px;
        right: 30px;
    }

    #circle-div {
        display: flex;
        position: fixed;
        bottom: 45px;
        right: 30px;
    }

    .slick-prev:before {
        display: none;
    }

    .slick-next:before {
        display: none;
    }
</style>
<div class="site-index">

    <!-- <div class="text-center mt-4 mb-5">
        <h1 class="display-6">Polling Dosen dan Mahasiswa Terpopuler!</h1>
    </div> -->
    <!-- <div id="circle-div" style="display: none;">
        <div class="row">
            <a href=<?= Url::to(['/dosen/pilih']) ?> style="text-decoration: none;" class="btn-sm btn-success btn-block">Dosen</a>
        </div>
    </div> -->
    <div id="circle-div2" style="display: none;">
        <div class="row">
            <!-- <a href=<?= Url::to(['/dosen/pilih']) ?> style="text-decoration: none;" class="btn-sm btn-success btn-block">Mahasiswa</a> -->
            <a href='#' onclick="scrollToTop()" style="text-decoration: none;" class="btn btn-success btn-block"><i class="arrow up"></i></a>
        </div>
    </div>


    <div class="body-content mb-5">
        <div id="pilih" class="card bg-gradient-primary px-4 shadow">
            <div class="row pb-3">
                <div class="col-6">
                    <a href=<?= Url::to(['/dosen/pilih']) ?> class="mt-4 btn btn-success btn-block">Pilih Dosen</a>
                </div>
                <div class="col-6">
                    <a href=<?= Url::to(['/mahasiswa/pilih']) ?> class="mt-4 btn btn-success btn-block">Pilih Mahasiswa</a>
                </div>
            </div>
        </div>

        <div class="card my-5 px-4 py-4 shadow">
            <div class="row">
                <div class="col-3">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" onChange="graphSwitch(this.id)" id="universitas">
                        <label class="custom-control-label" for="universitas">Grafik</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-center mb-3">
                        <h4 class="display-6 font-weight-bold">Terpopuler di Universitas</h4>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row">
                <div class="col-6 text-center justify-content-center">
                    <div class="card shadow-sm">
                        <div>
                            <h5 class="font-weight-bold mt-3">Dosen</h5>
                            <div class="card-body mb-4">
                                <?php echo $tableDosenUniversitas; ?>
                                <canvas class="graph-universitas mt-5" id="dosenUniversitas" style="width:20%; display:none;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 text-center justify-content-center">
                    <div class="card shadow-sm">
                        <div>
                            <h5 class="font-weight-bold mt-3">Mahasiswa</h5>
                            <div class="card-body mb-4">
                                <?php echo $tableMahasiswaUniversitas; ?>
                                <canvas class="graph-universitas mt-5" id="mahasiswaUniversitas" style="width:20%; display:none;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-6 text-center justify-content-center mb-3">
                    <div class="card shadow-sm">
                        <h5 class="font-weight-bold mt-3">Dosen</h5>
                        <div class="items">
                            <div>
                                <div class="card-body mt-4">
                                    <?php echo $tableDosenFEB; ?>
                                </div>
                            </div>
                            <div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <canvas id="myChart" style="width:20%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="col-6 text-center justify-content-center">
                    <div class="card shadow-sm">
                        <h5 class="font-weight-bold mt-3">Mahasiswa Terpopuler</h5>
                        <div class="card-body">
                            <?php echo $tableMahasiswaUniversitas; ?>
                            <a href=<?= Url::to(['/mahasiswa/pilih']) ?> class="mt-4 btn btn-primary btn-block">Pilih Mahasiswa</a>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-6">
                                    <div id="dosenUniversitas" class="mt-3 btn btn-primary btn-block">Tampilkan Grafik</div>
                                </div>
                                <div class="col-3"></div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-6 text-center justify-content-center mb-3">
                    <div class="card shadow-sm">
                        <h5 class="font-weight-bold mt-3">Mahasiswa</h5>
                        <div class="items">
                            <div>
                                <div class="card-body mt-4">
                                    <?php echo $tableMahasiswaUniversitas; ?>
                                </div>
                            </div>
                            <div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <canvas id="myChartt" style="width:20%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div id="graph-dosenUniversitas" class="col-6 text-center justify-content-center mb-3" style="display:none;">
                    <div class="card shadow-sm">
                        <h5 class="font-weight-bold mt-3">Grafik</h5>
                        <div class="card-body">
                            <div class="card-body">
                                <canvas id="myChart" style="width:20%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>

        <div class="card my-5 px-4 py-4 shadow">
            <div class="row">
                <div class="col-3">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" onChange="graphSwitch(this.id)" id="fakultas">
                        <label class="custom-control-label" for="fakultas">Grafik</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-center mb-3">
                        <h4 class="display-6 font-weight-bold">Terpopuler di Fakultas</h4>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row">
                <div class="col-6 text-center justify-content-center">
                    <div class="card shadow-sm">
                        <div class="items">
                            <div>
                                <h5 class="font-weight-bold mt-3">Fakultas Ekonomi dan Bisnis</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenFEB; ?>
                                    <canvas class="graph-fakultas mt-5" id="dosenFEB" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Fakultas Ilmu Komunikasi</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenFIK; ?>
                                    <canvas class="graph-fakultas mt-5" id="dosenFIK" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Fakultas Teknik</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenFT; ?>
                                    <canvas class="graph-fakultas mt-5" id="dosenFT" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Fakultas Psikologi</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenFP; ?>
                                    <canvas class="graph-fakultas mt-5" id="dosenFP" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 text-center justify-content-center">
                    <div class="card shadow-sm">
                        <div class="items">
                            <div>
                                <h5 class="font-weight-bold mt-3">Fakultas Ekonomi dan Bisnis</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaFEB; ?>
                                    <canvas class="graph-fakultas mt-5" id="mahasiswaFEB" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Fakultas Ilmu Komunikasi</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaFIK; ?>
                                    <canvas class="graph-fakultas mt-5" id="mahasiswaFIK" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Fakultas Teknik</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaFT; ?>
                                    <canvas class="graph-fakultas mt-5" id="mahasiswaFT" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Fakultas Psikologi</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaFP; ?>
                                    <canvas class="graph-fakultas mt-5" id="mahasiswaFP" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card my-5 px-4 py-4 shadow">
            <div class="row">
                <div class="col-3">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" onChange="graphSwitch(this.id)" id="prodi">
                        <label class="custom-control-label" for="prodi">Grafik</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-center mb-3">
                        <h4 class="display-6 font-weight-bold">Terpopuler di Program Studi</h4>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row">
                <div class="col-6 text-center justify-content-center">
                    <div class="card shadow-sm">
                        <div class="items">
                            <div>
                                <h5 class="font-weight-bold mt-3">Akuntansi</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenAkuntansi; ?>
                                    <canvas class="graph-prodi mt-5" id="dosenAkuntansi" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Manajemen</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenManajemen; ?>
                                    <canvas class="graph-prodi mt-5" id="dosenManajemen" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Desain Komunikasi Visual</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenDKV; ?>
                                    <canvas class="graph-prodi mt-5" id="dosenDKV" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Ilmu Komunikasi</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenIlkom; ?>
                                    <canvas class="graph-prodi mt-5" id="dosenIlkom" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Psikologi</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenPsikologi; ?>
                                    <canvas class="graph-prodi mt-5" id="dosenPsikologi" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Arsitektur</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenArsitektur; ?>
                                    <canvas class="graph-prodi mt-5" id="dosenArsitektur" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Informatika</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenInformatika; ?>
                                    <canvas class="graph-prodi mt-5" id="dosenInformatika" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Sistem Informasi</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenSi; ?>
                                    <canvas class="graph-prodi mt-5" id="dosenSi" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Teknik Industri</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenIndustri; ?>
                                    <canvas class="graph-prodi mt-5" id="dosenIndustri" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Teknik Sipil</h5>
                                <div class="card-body">
                                    <?php echo $tableDosenSipil; ?>
                                    <canvas class="graph-prodi mt-5" id="dosenSipil" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 text-center justify-content-center">
                    <div class="card shadow-sm">
                        <div class="items">
                            <div>
                                <h5 class="font-weight-bold mt-3">Akuntansi</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaAkuntansi; ?>
                                    <canvas class="graph-prodi mt-5" id="mahasiswaAkuntansi" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Manajemen</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaManajemen; ?>
                                    <canvas class="graph-prodi mt-5" id="mahasiswaManajemen" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Desain Komunikasi Visual</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaDKV; ?>
                                    <canvas class="graph-prodi mt-5" id="mahasiswaDKV" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Ilmu Komunikasi</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaIlkom; ?>
                                    <canvas class="graph-prodi mt-5" id="mahasiswaIlkom" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Psikologi</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaPsikologi; ?>
                                    <canvas class="graph-prodi mt-5" id="mahasiswaPsikologi" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Arsitektur</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaArsitektur; ?>
                                    <canvas class="graph-prodi mt-5" id="mahasiswaArsitektur" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Informatika</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaInformatika; ?>
                                    <canvas class="graph-prodi mt-5" id="mahasiswaInformatika" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Sistem Informasi</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaSi; ?>
                                    <canvas class="graph-prodi mt-5" id="mahasiswaSi" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Teknik Industri</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaIndustri; ?>
                                    <canvas class="graph-prodi mt-5" id="mahasiswaIndustri" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                            <div>
                                <h5 class="font-weight-bold mt-3">Teknik Sipil</h5>
                                <div class="card-body">
                                    <?php echo $tableMahasiswaSipil; ?>
                                    <canvas class="graph-prodi mt-5" id="mahasiswaSipil" style="width:20%; display:none;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script>
    // function toggle(id) {
    //     var graph = '.graph' + id;
    //     $(graph).toggle();
    //     // if ($('#table-' + id).is(":visible")) {

    //     //     $('#table-' + id).hide();
    //     //     $('#graph-' + id).show();
    //     // } else if (!($('#table-' + id).is(":visible"))) {

    //     //     $('#table-' + id).show();
    //     //     $('#graph-' + id).hide();
    //     // }

    // }
    function graphSwitch(id) {
        // $('.graphProdi').toggle()
        var graph = '.graph-' + id;
        $(graph).toggle();
    }

    // $(document).ready(function() {
    //     // alert($('#customSwitches').is(":checked"))

    //     if ($('#customSwitches').is(':checked')) {
    //         alert('asd')
    //         $('.graph-prodi').show();
    //     }
    //     // else {
    //     //     $('.graph-prodi').hide();

    //     // }
    // });

    // $(function() {
    //     $('#switch-prodi').change(function() {
    //         if ($(this).prop('checked') == true) {
    //             alert($(this).prop('checked'))
    //             $('.graph-prodi').show();
    //         } else {
    //             $('.graph-prodi').hide();
    //         }
    //     })
    // })

    // $(function() {
    //     $('#toggle-event').change(function() {
    //         $('#console-event').html('Toggle: ' + $(this).prop('checked'))
    //     })
    // })
    // $(document).ready(function() {
    //     $('#toggle-event').change(function() {
    //         // alert($(this).prop('checked'))
    //         alert('asd')
    //         // $('#console-event').html('Toggle: ' + $(this).prop('checked'))
    //     })
    // })

    function scrollToTop() {

        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    }

    $(document).ready(function() {
        window.addEventListener("scroll", myScrollFunc);
    })

    // window.addEventListener("scroll", myScrollFunc);
    var myScrollFunc = function() {
        var y = window.scrollY;
        // alert(y)
        if (y >= 200) {
            $("#circle-div").fadeIn();
            $("#circle-div2").fadeIn();
            // $("#pilih").addClass('float');
        } else {
            $("#circle-div").fadeOut();
            $("#circle-div2").fadeOut();
        }
    };

    // var xValues = ['dosen A', 'dosen B', 'dosen C'];
    var yValues = [520, 391, 210];
    var val = Math.max(...yValues) + (0.1 * Math.max(...yValues))

    new Chart("mahasiswaUniversitas", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaUniversitas as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaUniversitas as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("dosenUniversitas", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenUniversitas as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenUniversitas as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("dosenFT", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenFT as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenFT as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("dosenFP", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenFP as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenFP as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("dosenFIK", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenFIK as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenFIK as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("dosenFEB", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenFEB as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenFEB as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("mahasiswaFT", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaFT as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaFT as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("mahasiswaFP", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaFP as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaFP as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("mahasiswaFIK", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaFIK as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaFIK as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("mahasiswaFEB", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaFEB as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaFEB as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("dosenAkuntansi", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenAkuntansi as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenAkuntansi as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("dosenManajemen", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenManajemen as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenManajemen as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    new Chart("dosenDKV", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenDKV as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenDKV as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    new Chart("dosenIlkom", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenIlkom as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenIlkom as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    new Chart("dosenPsikologi", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenPsikologi as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenPsikologi as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    new Chart("dosenArsitektur", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenArsitektur as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenArsitektur as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    new Chart("dosenInformatika", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenInformatika as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenInformatika as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    new Chart("dosenSi", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenSi as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenSi as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("dosenIndustri", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenIndustri as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenIndustri as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("dosenSipil", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataDosenSipil as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataDosenSipil as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("mahasiswaAkuntansi", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaAkuntansi as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaAkuntansi as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("mahasiswaManajemen", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaManajemen as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaManajemen as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    new Chart("mahasiswaDKV", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaDKV as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaDKV as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    new Chart("mahasiswaIlkom", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaIlkom as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaIlkom as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    new Chart("mahasiswaPsikologi", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaPsikologi as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaPsikologi as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    new Chart("mahasiswaArsitektur", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaArsitektur as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaArsitektur as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    new Chart("mahasiswaInformatika", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaInformatika as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaInformatika as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    new Chart("mahasiswaSi", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaSi as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaSi as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("mahasiswaIndustri", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaIndustri as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaIndustri as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    new Chart("mahasiswaSipil", {
        type: "horizontalBar",
        data: {
            // labels: xValues,
            labels: [<?php foreach ($dataMahasiswaSipil as $dt) {
                            echo "'" .  $dt["nama"] . "', ";
                        }
                        ?>],
            datasets: [{
                label: 'Total Polling',
                fill: false,
                lineTension: 0,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                data: [<?php foreach ($dataMahasiswaSipil as $dt) {
                            echo "'" .  $dt["total_polling"] . "', ";
                        }
                        ?>],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });



    $(document).ready(function() {
        $('.site').DataTable({
            "paging": false,
            "lengthChange": false,
            "pageLength": 10,
            "ordering": false,
            "info": false,
            "searching": false,
            "columns": [{
                    "width": "0%"
                },
                {
                    "width": "100%"
                },
                {
                    "width": "0%"
                },
            ],
            "columnDefs": [{
                    "targets": [0, 1, 2],
                    "className": "text-center",
                },
                {
                    "targets": [0],
                    "style": "width: 0%;",
                }
            ],
        });
    });

    $(document).ready(function() {

        $('.items').slick({
            autoplay: true,
            autoplaySpeed: 3500,
            dots: true,
            infinite: true,
            // speed: 100,
            cssEase: 'linear'
        });
    });
</script>