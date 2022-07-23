<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Mahasiswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mahasiswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nim')->textInput() ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?php 
    $prodi = [
        '0' => 'Informatika',
        '1' => 'Sistem Informasi',
    ]
    ?>
    <?= $form->field($model, 'prodi')->dropDownList($prodi, ['prompt' => '--Pilih Prodi--']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!-- <?= $form->field($model, 'prodi')->dropDownList($prodi, ['prompt' => '']) ?>
<?= $form->field($model, 'prodi')->dropDownList(ArrayHelper::map($prodi, 'prodi', $prodi)) ?> -->
