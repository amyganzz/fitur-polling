<?php

use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$this->title = 'Pilih Dosen Terpopuler';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <!-- <a id="tombs" href="javascript:void(0)" onclick="test();" title="View" class="text-success"><span class="badge badge-warning">Simpan</span></a> -->
    <p>
        <button type="button" onclick="asd()" class="btn btn-success pull-right">Submit</button>

        <!-- <?= Html::a('Simpan', ['pilih'], ['class' => 'btn btn-success', 'onclick' => 'asd();']) ?> -->
        <!-- <?= Html::a('Simpan', ['insert'], ['class' => 'btn btn-success']) ?> -->

        <!-- <?= Html::a('Tes', [''], ['class' => 'btn btn-success', 'onclick' => 'asd();']) ?> -->
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'id' => 'pildos',
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
        ],
        'options' => ['style' => 'text-transform: uppercase;'],
        'summary' => '*Wajib pilih 3'
    ]); ?>

    <script type="text/javascript">
        // action for all selected rows

        // function submit() {
        //     var keys = $('#grid').yiiGridView('getSelectedRows');
        //     alert(keys);
        //     var dialog = confirm("Are you sure to submit the installment?");
        //     if (dialog == true) {
        //         var keys = $('#grid').yiiGridView('getSelectedRows');
        //         // console.log(keys);
        //         var ajax = new XMLHttpRequest();
        //         $.ajax({
        //             type: "POST",
        //             url: 'http://localhost/ta/frontend/web/dosen/insert',
        //             data: {
        //                 keylist: keys
        //             },
        //             success: function(result) {
        //                 console.log(result);
        //             }
        //         });
        //     }
        // }
    </script>

    <script>
        function asd() {
            var val = $('input[type=checkbox]:checked').map(function(_, el) {
                var val = $(el).val();
                return val;
            }).get();

            // alert(val);
            if (confirm("Simpan Pilihan?") == true) {
                $.ajax({
                        url: 'http://localhost/ta/frontend/web/site/insert',
                        // url: <?= Url::to(['/dosen/insert']) ?>,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            nid: val
                        }
                    })
                    .done(function(response) {
                        alert(response.response_message);
                        window.location.href = '<?= BaseUrl::base();?>';
                    })
                    .fail(function(response) {
                        alert(response.response_code);
                    });
            }

            // $.ajax({

            //     type: 'POST',
            //     url: 'http://localhost/ta/frontend/web/index.php?r=dosen%2Finsert',
            //     // url: <?= Url::to(['/dosen/insert']) ?>,
            //     data: {
            //         nid: val,
            //         _csrf : '<?= Yii::$app->request->getCsrfToken() ?>'
            //     },
            //     dataType: 'json',
            //     success: function() {
            //         console.log(val);
            //     },
            //     error: function() {
            //         console.log(val);
            //     }
            // });
            // debugger;
            // $.ajax({

            //     type: "POST",



            //     url: 'http://localhost/ta/frontend/web/index.php?r=dosen%2Finsert', // your controller action

            //     dataType: 'json',

            //     data: { 'nid': nid },

            //     success: function (data) {
            //         //do something
            //         // console.log(data);
            //         alert("working");
            //     },

            //     error: function (errormessage) {

            //         //do something else
            //         // console.log(nid);
            //         alert("not asd");

            //     }
            //     // success: function (data) {

            //     //     alert('I did it! Processed checked rows.')

            //     // },

            // });
        }
    </script>
</div>