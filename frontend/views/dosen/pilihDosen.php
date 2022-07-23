<?php

use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Pilih Dosen Terpopuler';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <button type="button" onclick="insertPilihan('dosen')" class="btn btn-success pull-right">Submit</button>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'id' => 'pildos',
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => false
            ],

            'nid',
            [
                'label' => 'nama dosen',
                'attribute' => 'nama',
                'contentOptions' => ['style' => 'width:50%; white-space: normal;'],
            ],
            [
                'label' => 'Total Polling',
                'attribute' => 'total_polling',
                'contentOptions' => ['style' => 'width:20%; white-space: normal;'],
            ]
        ],
        'options' => ['style' => 'text-transform: uppercase;'],
        'summary' => '*Wajib Memberikan 3 Pilihan'
    ]); ?>

</div>
<script>
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
                                        controller: currentController
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
    </script>