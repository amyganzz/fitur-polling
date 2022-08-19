<?php

namespace frontend\controllers;

use Yii;
use app\models\Dosen;
use app\models\DosenSearch;
use yii\web\Controller;
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

    public function creatQuery($kode_prodi, $angkatan)
    {
        $query = 'SELECT nid, nama, nama_prodi AS prodi, nama_fakultas AS fakultas, total_polling 
                FROM dosen d
                JOIN prodi p ON d.prodi = p.kode_prodi
                JOIN fakultas f ON d.fakultas = f.kode_fakultas ';

        $addParam = 'WHERE prodi = ' . "'" . $kode_prodi . "'";
        $query .= $addParam;

        return $query;
    }

    /**
     * Pilih Dosen page
     * Show all Dosen to be choosen
     */
    public function actionPilih()
    {
        // MEMBUKA KONEKSI MENUJU DATABASE
        $db = Yii::$app->db;

        // MELAKUKAN PENGECEKAN APAKAH USER SUDAH LOGIN
        if (empty(Yii::$app->user->identity->username)) {
            return $this->redirect(['site/login']); 
        }

        // PROSES PENGECEKAN APAKAH USER SUDAH PERNAH MEMILIH DOSEN TERPOPULER
        $username = "'" . Yii::$app->user->identity->username . "'";
        $year = date("Y");
        $query = 'SELECT pilih_dosen  
                FROM user
                WHERE username = ' . $username;

        $exec = $db->createCommand($query)->queryAll();
        $user = $exec[0]["pilih_dosen"]; //MENGAMBIL VALUE pilih_dosen

        // MEMBANDINGKAN DATA TAHUN PEMILIHAN DOSEN, DENGAN TAHUN SAAT INI
        if ($user == $year) {
            $message = "Anda Telah Memberikan Pilihan Tahun Ini";
        }
        else {
            $message = NULL;
        }

        //PROSES QUERY MASING-MASING PROGRAM STUDI
        $queryAkuntansi = $this->creatQuery('AK1', '');
        $queryManajemen = $this->creatQuery('ME1', '');
        $queryDKV = $this->creatQuery('DK1', '');
        $queryIlkom = $this->creatQuery('IK1', '');
        $queryPsikologi = $this->creatQuery('PS1', '');
        $queryArsitektur = $this->creatQuery('AR1', '');
        $queryInformatika = $this->creatQuery('IF4', '');
        $querySi = $this->creatQuery('MF4', '');
        $queryIndustri = $this->creatQuery('MI4', '');
        $querySipil = $this->creatQuery('TS4', '');

        //PROSES REQUEST DATA KE DATABASE UNTUK DATA DOSEN BERDASARKAN PROGRAM STUDI
        $dataAkuntansi = $db->createCommand($queryAkuntansi)->queryAll();
        $dataManajemen = $db->createCommand($queryManajemen)->queryAll();
        $dataDKV = $db->createCommand($queryDKV)->queryAll();
        $dataIlkom = $db->createCommand($queryIlkom)->queryAll();
        $dataPsikologi = $db->createCommand($queryPsikologi)->queryAll();
        $dataArsitektur = $db->createCommand($queryArsitektur)->queryAll();
        $dataInformatika = $db->createCommand($queryInformatika)->queryAll();
        $dataSi = $db->createCommand($querySi)->queryAll();
        $dataIndustri = $db->createCommand($queryIndustri)->queryAll();
        $dataSipil = $db->createCommand($querySipil)->queryAll();

        //MEMBUAT MASING-MASING TABLE DENGAN MENGGUNAKAN HASIL DATA SEBELUMNYA
        $tbAkuntansi = $this->table($dataAkuntansi);
        $tbManajemen = $this->table($dataManajemen);
        $tbDKV = $this->table($dataDKV);
        $tbIlkom = $this->table($dataIlkom);
        $tbPsikologi = $this->table($dataPsikologi);
        $tbArsitektur = $this->table($dataArsitektur);
        $tbInformatika = $this->table($dataInformatika);
        $tbSi = $this->table($dataSi);
        $tbIndustri = $this->table($dataIndustri);
        $tbSipil = $this->table($dataSipil);

        //STRUKTUR HTML UNTUK MASING-MASING TABEL
        $tabelAkuntansi = '<div class="feb" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="akuntansi" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Akuntansi</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="dosen-akuntansi" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbAkuntansi . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

        $tabelManajemen = '<div class="feb" style="display: none;">
                                <div class="row justify-content-center">
                                    <div class="col-4">
                                        <a id="manajemen" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Manajemen</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-10">
                                        <div id="dosen-manajemen" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                        ' . $tbManajemen . '
                                        </div>
                                    </div>
                                    <div class="col-1" style="display: contents;"></div>
                                </div>
                            </div>
                            ';

        $tabelDKV = '<div class="fik" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="dkv" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Desain Komunikasi Visual</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="dosen-dkv" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbDKV . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

        $tabelIlkom = '<div class="fik" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="ilkom" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Ilmu Komunikasi</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="dosen-ilkom" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbIlkom . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

        $tabelPsikologi = '<div class="fp" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="psikologi" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Psikologi</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="dosen-psikologi" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbPsikologi . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

        $tabelArsitektur = '<div class="ft" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="arsitektur" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Arsitektur</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="dosen-arsitektur" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbArsitektur . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

        $tabelInformatika = '<div class="ft" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="informatika" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Informatika</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="dosen-informatika" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbInformatika . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

        $tabelIndustri = '<div class="ft" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="industri" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Industri</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="dosen-industri" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbIndustri . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

        $tabelSi = '<div class="ft" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="si" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Sistem Informasi</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="dosen-si" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbSi . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

        $tabelSipil = '<div class="ft" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="sipil" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Teknik Sipil</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="dosen-sipil" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbSipil . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

        $akuntansi[] = $tabelAkuntansi;
        $akuntansi[] = $tabelManajemen;
        $akuntansi[] = $tabelDKV;
        $akuntansi[] = $tabelIlkom;
        $akuntansi[] = $tabelPsikologi;
        $akuntansi[] = $tabelArsitektur;
        $akuntansi[] = $tabelInformatika;
        $akuntansi[] = $tabelSi;
        $akuntansi[] = $tabelIndustri;
        $akuntansi[] = $tabelSipil;

        return $this->render('pilihDosen', [
            'akuntansi' => $akuntansi,
            'message' => $message
            // 'manajemen' => $tbManajemen,
            // 'dkv' => $tbDKV,
            // 'ilkom' => $tbIlkom,
            // 'psikologi' => $tbPsikologi,
            // 'arsitektur' => $tbArsitektur,
            // 'informatika' => $tbInformatika,
            // 'si' => $tbSi,
            // 'industri' => $tbIndustri,
            // 'sipil' => $tbSipil
        ]);
    }

    public function table($data)
    {
        $table = '<table class="dosen">
                    <thead>
                        <tr>
                            <th></th>
                            <th>NID</th>
                            <th>NAMA DOSEN</th>
                            <th>PROGRAM STUDI</th>
                            <th>FAKULTAS</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($data as $dt) {
            $table .=
                '<tr>
                <td><input type="checkbox" value="' . $dt["nid"] . '"></td>
                <td>' . $dt["nid"] . '</td>
                <td>' . $dt["nama"] . '</td>
                <td>' . $dt["prodi"] . '</td>
                <td>' . $dt["fakultas"] . '</td>
                </tr>';
        }

        $table .=   '</tbody>
                </table>';

        return $table;
    }

    public function actionCheck()
    {
        $post = $_POST['datas'];
        $encode = json_encode($post);
        $data = trim($encode, '[]');

        $query = 'SELECT nid, nama, nama_prodi AS prodi, nama_fakultas AS fakultas, total_polling 
                FROM dosen d
                JOIN prodi p ON d.prodi = p.kode_prodi
                JOIN fakultas f ON d.fakultas = f.kode_fakultas
                WHERE nid in (' . $data . ')';

        $db = Yii::$app->db;
        $dataPilihan = $db->createCommand($query)->queryAll();

        $table = '<table style="margin:15px auto;">
                    <thead>
                        <tr>
                            <th style="width: 20%;">NID</th>
                            <th style="width: 30%;">NAMA</th>
                            <th style="width: 30%;">PROGRAM STUDI</th>
                            <th style="width: 20%;">FAKULTAS</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($dataPilihan as $dt) {
            $table .=
                '<tr>
                    <td>' . $dt["nid"] . '</td>
                    <td>' . $dt["nama"] . '</td>
                    <td>' . $dt["prodi"] . '</td>
                    <td>' . $dt["fakultas"] . '</td>
                </tr>';
        }

        $table .=   '</tbody>
                </table>';

        $response = array(
            "data" => $table
        );

        echo json_encode($response);
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
}
