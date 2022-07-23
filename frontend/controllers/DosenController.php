<?php

namespace frontend\controllers;

use Yii;
use app\models\Dosen;
use app\models\DosenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DosenController implements the CRUD actions for Dosen model.
 */
class DosenController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Pilih Dosen page
     * Show all Dosen to be choosen
     */
    public function actionPilih()
    {

        $searchModel = new DosenSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('pilihDosen', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Lists all Dosen models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DosenSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Insert Polling for Dosen or Mahasiswa
     */
    public function actionInsert()
    {
        if (isset($_POST['nid'])) {

            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();

            $post = $_POST['nid'];
            $encode = json_encode($post);
            $data = trim($encode, '[]');

            try {
                $db->createCommand("UPDATE kampus.dosen_pilihan SET total = total + 1 WHERE nid in ($data)")->execute();
                $transaction->commit();

                $response = array(
                    "response_message" => "Success",
                    "data" => $data
                );

                echo json_encode($response);
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        } else if (isset($_POST['nim'])) {

            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();

            $post = $_POST['nim'];
            $encode = json_encode($post);
            $data = trim($encode, '[]');

            try {
                $db->createCommand("UPDATE kampus.mahasiswa_pilihan SET total = total + 1 WHERE nim in ($data)")->execute();
                $transaction->commit();

                $response = array(
                    "response_message" => "Success",
                    "data" => $data
                );

                echo json_encode($response);
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
    }

    /**
     * Displays a single Dosen model.
     * @param int $nid Nid
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($nid)
    {
        return $this->render('view', [
            'model' => $this->findModel($nid),
        ]);
    }

    /**
     * Creates a new Dosen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Dosen();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'nid' => $model->nid]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dosen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $nid Nid
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($nid)
    {
        $model = $this->findModel($nid);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nid' => $model->nid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dosen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $nid Nid
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($nid)
    {
        $this->findModel($nid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dosen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $nid Nid
     * @return Dosen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($nid)
    {
        if (($model = Dosen::findOne(['nid' => $nid])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
