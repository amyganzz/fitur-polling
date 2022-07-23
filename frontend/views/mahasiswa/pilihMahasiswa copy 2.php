<?php

use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Uri;
use yii\data\ActiveDataProvider;
use app\models\Mahasiswa;

$this->title = 'Pilih Mahasiswa Terpopuler';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mahasiswa-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <button type="button" onclick="insertPilihan()" class="btn btn-success pull-right">Submit</button>

    </p>
    
        // $query = Mahasiswa::findBySql(
        //         'SELECT *
        //         FROM mahasiswa m
        //         join jurusan j on m.prodi = j.id_jurusan'
        //     );

        // $provider = new ActiveDataProvider([
        //     'query' => $query,
        //     'pagination' => [
        //         'pageSize' => 10,
        //     ]
        // ]);
        
        // // returns an array of Post objects
        // $posts = $provider->getModels();
        // var_dump($provider);
        
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'dataProvider' => new ActiveDataProvider([
        //     'query' => $query,
        //     // 'query' => Mahasiswa::findBySql(
        //     //     'SELECT *
        //     //     FROM mahasiswa m
        //     //     join jurusan j on m.prodi = j.id_jurusan'
        //     // ),
        //     'sort' => false,
        // ]),
        'id' => 'pilmhs',
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
        ],
        'options' => ['style' => 'text-transform: uppercase;'],
        'summary' => '*Wajib pilih 3'
    ]); 
    // $posts = $provider->getModels();
    ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.19/dist/sweetalert2.all.min.js"></script>
    <script>
        function insertPilihan() {
            var current = '<?= Yii::$app->controller->id; ?>';
            var val = $('input[type=checkbox]:checked').map(function(_, el) {
                var val = $(el).val();
                return val;
            }).get();


            if ($('input[type=checkbox]:checked').length < 3) {
                // alert("Wajib Memberikan 3 Pilihan!");
                Swal.fire({
                    title: 'Wajib Memberikan 3 Pilihan!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            } else {
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
                                    // alert(response.response_message);
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
                                    // alert(response.response_message);
                                });
                        });
                    },
                    allowOutsideClick: false
                });
            }
        }

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