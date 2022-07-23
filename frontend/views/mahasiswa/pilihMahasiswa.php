<?php

use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Pilih Mahasiswa Terpopuler';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahasiswa-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <button type="button" onclick="insertPilihan('mahasiswa')" class="btn btn-success pull-right">Submit</button>

    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'id' => 'pilmhs',
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => false
            ],

            'nim',
            [
                'label' => 'nama mahasiswa',
                'attribute' => 'nama',
                'contentOptions' => ['style' => 'width:50%; white-space: normal;'],
            ],
            [
                'label' => 'prodi',
                'attribute' => 'prodi',
                'contentOptions' => ['style' => 'width:20%; white-space: normal;'],
            ],
            [
                'label' => 'Total Polling',
                'attribute' => 'total_polling',
                'contentOptions' => ['style' => 'width:20%; white-space: normal;'],
            ],
        ],
        'options' => ['style' => 'text-transform: uppercase;'],
        'summary' => '*Wajib Memberikan 3 Pilihan'
    ]); 
    ?>

    <script>
        //FUNCTION BUTTON SUBMIT
        function insertPilihan() {
            //MENGAMBIL VALUE NID DARI CHECKBOX YANG DIPILIH
            var current = '<?= Yii::$app->controller->id; ?>';
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
                        return new Promise(function(resolve) {
                            $.ajax({
                                    url: 'http://localhost/ta/frontend/web/site/insert',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        datas: val,
                                        controller: current
                                    }
                                })
                                .done(function(response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: response.response_message,
                                        confirmButtonColor: '#1cc88a',
                                    }).then(function() {
                                        window.location.href = '<?= BaseUrl::base(); ?>';
                                    });
                                })
                                .fail(function(response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: response.response_message,
                                        confirmButtonColor: '#1cc88a',
                                    }).then(function() {
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
    </script>
</div>