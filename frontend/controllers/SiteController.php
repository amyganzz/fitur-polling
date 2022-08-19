<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function creatQuery($kode, $group, $tipe)
    {

        if ($group == 'dosen') {
            $alias = 'd';
            $query = 'SELECT nid, nama, nama_prodi AS prodi, nama_fakultas AS fakultas, total_polling 
            FROM dosen d
            JOIN prodi p ON d.prodi = p.kode_prodi
            JOIN fakultas f ON d.fakultas = f.kode_fakultas';
        }
        else if ($group == 'mahasiswa') {
            $alias = 'm';
            $query = 'SELECT nim, nama, nama_prodi AS prodi, nama_fakultas AS fakultas, total_polling 
            FROM mahasiswa m
            JOIN prodi p ON m.prodi = p.kode_prodi
            JOIN fakultas f ON m.fakultas = f.kode_fakultas';
        }
        
        if ($tipe == 'fakultas') {
            $addParam = ' WHERE ' . $alias . '.fakultas = "' . $kode . '"';
            $query .= $addParam;
        }
        else if ($tipe == 'prodi') {
            $addParam = ' WHERE ' . $alias . '.prodi = "' . $kode . '"';
            $query .= $addParam;
        }

        $query .= ' ORDER BY total_polling DESC LIMIT 3';

        return $query;
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $db = Yii::$app->db;
        if (empty(Yii::$app->user->identity->username)) {
            return $this->redirect(['site/login']);
        }
        
        $queryDosenUniversitas = $this->creatQuery('', 'dosen', '');
        $queryMahasiswaUniversitas = $this->creatQuery('', 'mahasiswa', '');

        $queryDosenFEB = $this->creatQuery('FEB', 'dosen', 'fakultas');
        $queryDosenFP = $this->creatQuery('FP', 'dosen', 'fakultas');
        $queryDosenFIK = $this->creatQuery('FIK', 'dosen', 'fakultas');
        $queryDosenFT = $this->creatQuery('FT', 'dosen', 'fakultas');

        $queryDosenAkuntansi = $this->creatQuery('AK1', 'dosen', 'prodi');
        $queryDosenManajemen = $this->creatQuery('ME1', 'dosen', 'prodi');
        $queryDosenDKV = $this->creatQuery('DK1', 'dosen', 'prodi');
        $queryDosenIlkom = $this->creatQuery('IK1', 'dosen', 'prodi');
        $queryDosenPsikologi = $this->creatQuery('PS1', 'dosen', 'prodi');
        $queryDosenArsitektur = $this->creatQuery('AR1', 'dosen', 'prodi');
        $queryDosenInformatika = $this->creatQuery('IF4', 'dosen', 'prodi');
        $queryDosenSi = $this->creatQuery('MF4', 'dosen', 'prodi');
        $queryDosenIndustri = $this->creatQuery('MI4', 'dosen', 'prodi');
        $queryDosenSipil = $this->creatQuery('TS4', 'dosen', 'prodi');

        $queryMahasiswaFEB = $this->creatQuery('FEB', 'mahasiswa', 'fakultas');
        $queryMahasiswaFP = $this->creatQuery('FP', 'mahasiswa', 'fakultas');
        $queryMahasiswaFIK = $this->creatQuery('FIK', 'mahasiswa', 'fakultas');
        $queryMahasiswaFT = $this->creatQuery('FT', 'mahasiswa', 'fakultas');

        $queryMahasiswaAkuntansi = $this->creatQuery('AK1', 'mahasiswa', 'prodi');
        $queryMahasiswaManajemen = $this->creatQuery('ME1', 'mahasiswa', 'prodi');
        $queryMahasiswaDKV = $this->creatQuery('DK1', 'mahasiswa', 'prodi');
        $queryMahasiswaIlkom = $this->creatQuery('IK1', 'mahasiswa', 'prodi');
        $queryMahasiswaPsikologi = $this->creatQuery('PS1', 'mahasiswa', 'prodi');
        $queryMahasiswaArsitektur = $this->creatQuery('AR1', 'mahasiswa', 'prodi');
        $queryMahasiswaInformatika = $this->creatQuery('IF4', 'mahasiswa', 'prodi');
        $queryMahasiswaSi = $this->creatQuery('MF4', 'mahasiswa', 'prodi');
        $queryMahasiswaIndustri = $this->creatQuery('MI4', 'mahasiswa', 'prodi');
        $queryMahasiswaSipil = $this->creatQuery('TS4', 'mahasiswa', 'prodi');


        $dataDosenUniversitas = $db->createCommand($queryDosenUniversitas)->queryAll();
        $dataMahasiswaUniversitas = $db->createCommand($queryMahasiswaUniversitas)->queryAll();

        $dataDosenFEB = $db->createCommand($queryDosenFEB)->queryAll();
        $dataDosenFP = $db->createCommand($queryDosenFP)->queryAll();
        $dataDosenFIK = $db->createCommand($queryDosenFIK)->queryAll();
        $dataDosenFT = $db->createCommand($queryDosenFT)->queryAll();

        $dataMahasiswaFEB = $db->createCommand($queryMahasiswaFEB)->queryAll();
        $dataMahasiswaFP = $db->createCommand($queryMahasiswaFP)->queryAll();
        $dataMahasiswaFIK = $db->createCommand($queryMahasiswaFIK)->queryAll();
        $dataMahasiswaFT = $db->createCommand($queryMahasiswaFT)->queryAll();

        $dataDosenAkuntansi = $db->createCommand($queryDosenAkuntansi)->queryAll();
        $dataDosenManajemen = $db->createCommand($queryDosenManajemen)->queryAll();
        $dataDosenDKV = $db->createCommand($queryDosenDKV)->queryAll();
        $dataDosenIlkom = $db->createCommand($queryDosenIlkom)->queryAll();
        $dataDosenPsikologi = $db->createCommand($queryDosenPsikologi)->queryAll();
        $dataDosenArsitektur = $db->createCommand($queryDosenArsitektur)->queryAll();
        $dataDosenInformatika = $db->createCommand($queryDosenInformatika)->queryAll();
        $dataDosenSi = $db->createCommand($queryDosenSi)->queryAll();
        $dataDosenIndustri = $db->createCommand($queryDosenIndustri)->queryAll();
        $dataDosenSipil = $db->createCommand($queryDosenSipil)->queryAll();

        $dataMahasiswaAkuntansi = $db->createCommand($queryMahasiswaAkuntansi)->queryAll();
        $dataMahasiswaManajemen = $db->createCommand($queryMahasiswaManajemen)->queryAll();
        $dataMahasiswaDKV = $db->createCommand($queryMahasiswaDKV)->queryAll();
        $dataMahasiswaIlkom = $db->createCommand($queryMahasiswaIlkom)->queryAll();
        $dataMahasiswaPsikologi = $db->createCommand($queryMahasiswaPsikologi)->queryAll();
        $dataMahasiswaArsitektur = $db->createCommand($queryMahasiswaArsitektur)->queryAll();
        $dataMahasiswaInformatika = $db->createCommand($queryMahasiswaInformatika)->queryAll();
        $dataMahasiswaSi = $db->createCommand($queryMahasiswaSi)->queryAll();
        $dataMahasiswaIndustri = $db->createCommand($queryMahasiswaIndustri)->queryAll();
        $dataMahasiswaSipil = $db->createCommand($queryMahasiswaSipil)->queryAll();
        
        

        $tableDosenUniversitas = $this->table($dataDosenUniversitas);

        $tableDosenFEB = $this->table($dataDosenFEB);
        $tableDosenFIK = $this->table($dataDosenFIK);
        $tableDosenFT = $this->table($dataDosenFT);
        $tableDosenFP = $this->table($dataDosenFP);

        $tableDosenAkuntansi = $this->table($dataDosenAkuntansi);
        $tableDosenManajemen = $this->table($dataDosenManajemen);
        $tableDosenDKV = $this->table($dataDosenDKV);
        $tableDosenIlkom = $this->table($dataDosenIlkom);
        $tableDosenPsikologi = $this->table($dataDosenPsikologi);
        $tableDosenArsitektur = $this->table($dataDosenArsitektur);
        $tableDosenInformatika = $this->table($dataDosenInformatika);
        $tableDosenSi = $this->table($dataDosenSi);
        $tableDosenIndustri = $this->table($dataDosenIndustri);
        $tableDosenSipil = $this->table($dataDosenSipil);

        $tableMahasiswaUniversitas = $this->table($dataMahasiswaUniversitas);

        $tableMahasiswaFEB = $this->table($dataMahasiswaFEB);
        $tableMahasiswaFIK = $this->table($dataMahasiswaFIK);
        $tableMahasiswaFT = $this->table($dataMahasiswaFT);
        $tableMahasiswaFP = $this->table($dataMahasiswaFP);

        $tableMahasiswaAkuntansi = $this->table($dataMahasiswaAkuntansi);
        $tableMahasiswaManajemen = $this->table($dataMahasiswaManajemen);
        $tableMahasiswaDKV = $this->table($dataMahasiswaDKV);
        $tableMahasiswaIlkom = $this->table($dataMahasiswaIlkom);
        $tableMahasiswaPsikologi = $this->table($dataMahasiswaPsikologi);
        $tableMahasiswaArsitektur = $this->table($dataMahasiswaArsitektur);
        $tableMahasiswaInformatika = $this->table($dataMahasiswaInformatika);
        $tableMahasiswaSi = $this->table($dataMahasiswaSi);
        $tableMahasiswaIndustri = $this->table($dataMahasiswaIndustri);
        $tableMahasiswaSipil = $this->table($dataMahasiswaSipil);

        $tableMahasiswa = $this->table($dataMahasiswaUniversitas);

        // var_dump($dataDosenAkuntansi);die();
        // var_dump($queryMahasiswaUniversitas);die();
        // $queryDosenUniversitas = $this->creatQuery('', 'dosen', '');
        // $dataDosenUniversitas = $db->createCommand(
        //     'SELECT nama, nid, total_polling
        //         FROM dosen
        //         ORDER BY total_polling DESC
        //         LIMIT 3'
        // )->queryAll();

        // $dataMahasiswaUniversitas = $db->createCommand(
        //     'SELECT nama, nim, total_polling
        //         FROM mahasiswa
        //         ORDER BY total_polling DESC
        //         LIMIT 3'
        // )->queryAll();

        // $dataDosenFakultas = $db->createCommand(
        //     'SELECT nama, nid, total_polling
        //         FROM dosen
        //         WHERE fakultas = "FIK"
        //         ORDER BY total_polling DESC
        //         LIMIT 3'
        // )->queryAll();

        $tableDosen = $this->table($dataDosenUniversitas);
        $tableMahasiswa = $this->table($dataMahasiswaUniversitas);
        // $tableDosenFakultas = $this->table($dataDosenFakultas);

        // $tableDosen = '<table class="site">
        //     <thead>
        //         <tr>
        //             <th>NID</th>
        //             <th>NAMA DOSEN</th>
        //             <th>TOTAL POLLING</th>
        //         </tr>
        //     </thead>
        //     <tbody>';

        // foreach ($dataDosenUniversitas as $dt) {
        //     $tableDosen .=
        //         '<tr>
        //             <td>' . $dt["nid"] . '</td>
        //             <td>' . $dt["nama"] . '</td>
        //             <td>' . $dt["total_polling"] . '</td>
        //             </tr>';
        // }
        // $tableDosen .=   '</tbody>
        //             </table>';

        // $tableMahasiswa = '<table class="site">
        //     <thead>
        //         <tr>
        //             <th>NID</th>
        //             <th>NAMA MAHASISWA</th>
        //             <th>TOTAL POLLING</th>
        //         </tr>
        //     </thead>
        //     <tbody>';

        // foreach ($dataMahasiswaUniversitas as $dt) {
        //     $tableMahasiswa .=
        //         '<tr>
        //             <td>' . $dt["nim"] . '</td>
        //             <td>' . $dt["nama"] . '</td>
        //             <td>' . $dt["total_polling"] . '</td>
        //             </tr>';
        // }
        // $tableMahasiswa .=   '</tbody>
        //             </table>';
        // var_dump($dataDosenIlkom); die();

        return $this->render('index', [
            'tableDosenUniversitas' => $tableDosenUniversitas,
            'tableDosenFEB' => $tableDosenFEB,
            'tableDosenFIK' => $tableDosenFIK,
            'tableDosenFP' => $tableDosenFP,
            'tableDosenFT' => $tableDosenFT,

            'tableDosenAkuntansi' => $tableDosenAkuntansi,
            'tableDosenManajemen' => $tableDosenManajemen,
            'tableDosenDKV' => $tableDosenDKV,
            'tableDosenIlkom' => $tableDosenIlkom,
            'tableDosenPsikologi' => $tableDosenPsikologi,
            'tableDosenArsitektur' => $tableDosenArsitektur,
            'tableDosenInformatika' => $tableDosenInformatika,
            'tableDosenSi' => $tableDosenSi,
            'tableDosenIndustri' => $tableDosenIndustri,
            'tableDosenSipil' => $tableDosenSipil,

            'tableMahasiswaUniversitas' => $tableMahasiswaUniversitas,
            'tableMahasiswaFEB' => $tableMahasiswaFEB,
            'tableMahasiswaFIK' => $tableMahasiswaFIK,
            'tableMahasiswaFP' => $tableMahasiswaFP,
            'tableMahasiswaFT' => $tableMahasiswaFT,

            'tableMahasiswaAkuntansi' => $tableMahasiswaAkuntansi,
            'tableMahasiswaManajemen' => $tableMahasiswaManajemen,
            'tableMahasiswaDKV' => $tableMahasiswaDKV,
            'tableMahasiswaIlkom' => $tableMahasiswaIlkom,
            'tableMahasiswaPsikologi' => $tableMahasiswaPsikologi,
            'tableMahasiswaArsitektur' => $tableMahasiswaArsitektur,
            'tableMahasiswaInformatika' => $tableMahasiswaInformatika,
            'tableMahasiswaSi' => $tableMahasiswaSi,
            'tableMahasiswaIndustri' => $tableMahasiswaIndustri,
            'tableMahasiswaSipil' => $tableMahasiswaSipil,

            'dataMahasiswaUniversitas' => $dataMahasiswaUniversitas,
            'dataDosenUniversitas' => $dataDosenUniversitas,

            'dataDosenFEB' => $dataDosenFEB,
            'dataDosenFT' => $dataDosenFT,
            'dataDosenFIK' => $dataDosenFIK,
            'dataDosenFP' => $dataDosenFP,
            
            'dataMahasiswaFEB' => $dataMahasiswaFEB,
            'dataMahasiswaFT' => $dataMahasiswaFT,
            'dataMahasiswaFIK' => $dataMahasiswaFIK,
            'dataMahasiswaFP' => $dataMahasiswaFP,

            'dataDosenAkuntansi' => $dataDosenAkuntansi,
            'dataDosenManajemen' => $dataDosenManajemen,
            'dataDosenDKV' => $dataDosenDKV,
            'dataDosenIlkom' => $dataDosenIlkom,
            'dataDosenPsikologi' => $dataDosenPsikologi,
            'dataDosenArsitektur' => $dataDosenArsitektur,
            'dataDosenInformatika' => $dataDosenInformatika,
            'dataDosenSi' => $dataDosenSi,
            'dataDosenIndustri' => $dataDosenIndustri,
            'dataDosenSipil' => $dataDosenSipil,

            'dataMahasiswaAkuntansi' => $dataMahasiswaAkuntansi,
            'dataMahasiswaManajemen' => $dataMahasiswaManajemen,
            'dataMahasiswaDKV' => $dataMahasiswaDKV,
            'dataMahasiswaIlkom' => $dataMahasiswaIlkom,
            'dataMahasiswaPsikologi' => $dataMahasiswaPsikologi,
            'dataMahasiswaArsitektur' => $dataMahasiswaArsitektur,
            'dataMahasiswaInformatika' => $dataMahasiswaInformatika,
            'dataMahasiswaSi' => $dataMahasiswaSi,
            'dataMahasiswaIndustri' => $dataMahasiswaIndustri,
            'dataMahasiswaSipil' => $dataMahasiswaSipil,
            
            // 'tableMahasiswa' => $tableMahasiswa,
            // 'tableDosenFakultas' => $tableDosenFakultas,
            // 'graph' => $graph

        ]);
    }


    /**
     * Insert Polling for Dosen or Mahasiswa
     */
    public function actionInsert()
    {
        $username = "'" . Yii::$app->user->identity->username . "'";
        $year = date("Y");
        if (isset($_POST['datas'])) {

            try {
                $db = Yii::$app->db;
                $transaction = $db->beginTransaction();

                $currentController = $_POST['controller'];
                $post = $_POST['datas'];
                $encode = json_encode($post);
                $data = trim($encode, '[]');

                if ($currentController == 'dosen') {
                    $db->createCommand(
                        "UPDATE dosen SET total_polling = total_polling + 1 WHERE nid in ($data)"
                    )->execute();
                    // $transaction->commit();

                    $query = 'UPDATE kampus.`user`
                                SET pilih_dosen = ' . $year . ' 
                                WHERE username = ' . $username;
                    $db->createCommand($query)->execute();
                    $transaction->commit();

                    $response = array(
                        "response_message" => "Berhasil Memilih Dosen!",
                        "code" => 200
                    );

                    echo json_encode($response);
                } else if ($currentController == 'mahasiswa') {
                    $db->createCommand(
                        "UPDATE mahasiswa SET total_polling = total_polling + 1 WHERE nim in ($data)"
                    )->execute();
                    // $transaction->commit();

                    $query = 'UPDATE kampus.`user`
                                SET pilih_mahasiswa = ' . $year . ' 
                                WHERE username = ' . $username;
                    $db->createCommand($query)->execute();
                    $transaction->commit();

                    $response = array(
                        "response_message" => "Berhasil Memilih Mahasiswa!",
                        "code" => 200
                    );

                    echo json_encode($response);
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                var_dump($e);
                $response = array(
                    "response_message" => $e->getMessage(),
                    "code" => 500
                );

                echo json_encode($response);
            }
        } else {
            $response = array(
                "response_message" => 'Not Found',
                "code" => 404
            );

            echo json_encode($response);
        }
    }

    public function table($data)
    {
        if (array_key_exists("nid", $data[0])) {
            $nomor = "NID";
            $nama = "DOSEN";
        } else {
            $nomor = "NIM";
            $nama = "MAHASISWA";
        }
        $table = '<table class="site">
                    <thead>
                        <tr>
                            <th>' . $nomor . '</th>
                            <th>NAMA ' . $nama . '</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($data as $dt) {
            if (array_key_exists("nid", $dt)) {
                $table .=
                    '<tr>
                        <td>' . $dt["nid"] . '</td>
                        <td>' . $dt["nama"] . '</td>
                        <td>' . $dt["total_polling"] . '</td>
                    </tr>';
            } else {
                $table .=
                    '<tr>
                        <td>' . $dt["nim"] . '</td>
                        <td>' . $dt["nama"] . '</td>
                        <td>' . $dt["total_polling"] . '</td>
                    </tr>';
            }
        }

        $table .=   '</tbody>
                </table>';

        return $table;
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
