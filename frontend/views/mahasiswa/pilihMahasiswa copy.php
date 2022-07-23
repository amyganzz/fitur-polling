<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DosenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


// $script = <<< JS
//     function simpan() {
//         alert("Hi");

//     }
// JS;
// $this->registerJs($script);

$this->title = 'Pilih Mahasiswa Terpopuler';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <a href="javascript:void(0)" onclick="alert('hi')" title="View" class="text-success"><span class="badge badge-warning">Simpan</span></a>
    <!-- <p>
        <?= Html::a('Simpan', ['simpan'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            'nim',
            'nama',
            'prodi',
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'nid' => $model->nid]);
            //      }
            // ],
        ],
    ]); ?>


</div>