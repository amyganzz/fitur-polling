<?php

/** @var yii\web\View $this */

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use app\models\Mahasiswa;
use app\models\Dosen;
use yii\helpers\Url;


$this->title = 'My Yii Application';
?>

<div class="site-index">

    <div class="text-center mt-4 mb-5">
        <h1 class="display-6">Polling Dosen dan Mahasiswa Terpopuler!</h1>
    </div>

    <div class="body-content my-5">

        <div class="row ">
            <div class="col-6 text-center justify-content-center">
                <div class="card border border-dark">
                    <h5 class="font-weight-bold mt-3">Dosen Terpopuler</h5>
                    <div class="card-body">
                        <?= GridView::widget([

                            'dataProvider' => new ActiveDataProvider([
                                'query' => Dosen::findBySql($queryDosen),
                                'sort' => false,
                            ]),
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                [
                                    'attribute' => 'nid',
                                    'contentOptions' => ['style' => 'width:20%px; white-space: normal;'],
                                ],
                                [
                                    'label' => 'nama dosen',
                                    'attribute' => 'nama',
                                    'contentOptions' => ['style' => 'width:50%; white-space: normal;'],
                                ],
                                [
                                    'label' => 'total',
                                    'attribute' => 'total_polling',
                                    'contentOptions' => ['style' => 'width:10%; white-space: normal;'],
                                ],

                            ],
                            'options' => ['style' => 'text-transform: uppercase;'],
                            'summary' => ''

                        ]); 
                        ?>
                        <a href=<?= Url::to(['/dosen/pilih']) ?> class="btn btn-primary btn-block">Pilih Dosen</a>
                    </div>
                </div>
            </div>

            <div class="col-6 text-center justify-content-center">
                <div class="card border border-dark">
                    <h5 class="font-weight-bold mt-3">Mahasiswa Terpopuler</h5>
                    <div class="card-body">
                        <?= GridView::widget([


                            'dataProvider' => new ActiveDataProvider([
                                'query' => Mahasiswa::findBySql($queryMahasiswa),
                                'sort' => false,
                            ]),
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                [
                                    'attribute' => 'nim',
                                    'contentOptions' => ['style' => 'width:20%px; white-space: normal;'],
                                ],
                                [
                                    'label' => 'nama mahasiswa',
                                    'attribute' => 'nama',
                                    'contentOptions' => ['style' => 'width:50%; white-space: normal;'],
                                ],
                                [
                                    'label' => 'total',
                                    'attribute' => 'total_polling',
                                    'contentOptions' => ['style' => 'width:10%; white-space: normal;'],
                                ],

                            ],
                            'options' => ['style' => 'text-transform: uppercase;'],
                            'summary' => ''

                        ]); ?>
                        <a href=<?= Url::to(['/mahasiswa/pilih']) ?> class="btn btn-primary btn-block">Pilih Mahasiswa</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>