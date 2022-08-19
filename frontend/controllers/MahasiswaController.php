<?php

namespace frontend\controllers;

use Yii;
use app\models\Mahasiswa;
use app\models\MahasiswaSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/**
 * MahasiswaController implements the CRUD actions for Mahasiswa model.
 */
class MahasiswaController extends Controller
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
        $query = 'SELECT nim, nama, nama_prodi AS prodi, nama_fakultas AS fakultas, total_polling 
                FROM mahasiswa m
                JOIN prodi p ON m.prodi = p.kode_prodi
                JOIN fakultas f ON m.fakultas = f.kode_fakultas ';

        if (!(is_null($angkatan))) {
            $addParam = 'WHERE prodi = ' . "'" . $kode_prodi . "'" . ' AND nim like ' . "'" . $angkatan . "%'";
            $query .= $addParam;
        } else {
            $addParam = 'WHERE prodi = ' . "'" . $kode_prodi . "'";
            $query .= $addParam;
        }

        return $query;
    }

    public function actionPilih()
    {
        $db = Yii::$app->db;
        if (empty(Yii::$app->user->identity->username)) {
            return $this->redirect(['site/login']); 
        }
        $username = "'" . Yii::$app->user->identity->username . "'";
        $year = date("Y");
        $query = 'SELECT pilih_mahasiswa  
                FROM user
                WHERE username = ' . $username;

        $exec = $db->createCommand($query)->queryAll();
        $user = $exec[0]["pilih_mahasiswa"];

        if ($user == $year) {
            $message = "Anda Telah Memberikan Pilihan Tahun Ini";
        }
        else {
            $message = NULL;
        }
        // var_dump($user == $year);
        // die();
        $angkatans = [
            '15',
            '16',
            '17',
            '18',
            '19',
            '20',
            '21',
            '22'
        ];

        for ($i = 0; $i < count($angkatans); $i++) {
            $queryAkuntansi = $this->creatQuery('AK1', $angkatans[$i]);
            $queryManajemen = $this->creatQuery('ME1', $angkatans[$i]);
            $queryDKV = $this->creatQuery('DK1', $angkatans[$i]);
            $queryIlkom = $this->creatQuery('IK1', $angkatans[$i]);
            $queryPsikologi = $this->creatQuery('PS1', $angkatans[$i]);
            $queryArsitektur = $this->creatQuery('AR1', $angkatans[$i]);
            $queryInformatika = $this->creatQuery('IF4', $angkatans[$i]);
            $querySi = $this->creatQuery('MF4', $angkatans[$i]);
            $queryIndustri = $this->creatQuery('MI4', $angkatans[$i]);
            $querySipil = $this->creatQuery('TS4', $angkatans[$i]);

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

            $tabelAkuntansi = '<div class="feb-20' . $angkatans[$i] . '" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="akuntansi-20' . $angkatans[$i] . '" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Akuntansi</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="mahasiswa-akuntansi-20' . $angkatans[$i] . '" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbAkuntansi . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

            $tabelManajemen = '<div class="feb-20' . $angkatans[$i] . '" style="display: none;">
                                <div class="row justify-content-center">
                                    <div class="col-4">
                                        <a id="manajemen-20' . $angkatans[$i] . '" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Manajemen</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-10">
                                        <div id="mahasiswa-manajemen-20' . $angkatans[$i] . '" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                        ' . $tbManajemen . '
                                        </div>
                                    </div>
                                    <div class="col-1" style="display: contents;"></div>
                                </div>
                            </div>
                            ';

            $tabelDKV = '<div class="fik-20' . $angkatans[$i] . '" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="dkv-20' . $angkatans[$i] . '" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Desain Komunikasi Visual</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="mahasiswa-dkv-20' . $angkatans[$i] . '" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbDKV . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

            $tabelIlkom = '<div class="fik-20' . $angkatans[$i] . '" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="ilkom-20' . $angkatans[$i] . '" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Ilmu Komunikasi</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="mahasiswa-ilkom-20' . $angkatans[$i] . '" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbIlkom . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

            $tabelPsikologi = '<div class="fp-20' . $angkatans[$i] . '" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="psikologi-20' . $angkatans[$i] . '" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Psikologi</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="mahasiswa-psikologi-20' . $angkatans[$i] . '" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbPsikologi . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

            $tabelArsitektur = '<div class="ft-20' . $angkatans[$i] . '" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="arsitektur-20' . $angkatans[$i] . '" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Arsitektur</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="mahasiswa-arsitektur-20' . $angkatans[$i] . '" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbArsitektur . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

            $tabelInformatika = '<div class="ft-20' . $angkatans[$i] . '" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="informatika-20' . $angkatans[$i] . '" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Informatika</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="mahasiswa-informatika-20' . $angkatans[$i] . '" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbInformatika . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

            $tabelIndustri = '<div class="ft-20' . $angkatans[$i] . '" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="industri-20' . $angkatans[$i] . '" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Industri</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="mahasiswa-industri-20' . $angkatans[$i] . '" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbIndustri . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

            $tabelSi = '<div class="ft-20' . $angkatans[$i] . '" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="si-20' . $angkatans[$i] . '" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Sistem Informasi</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="mahasiswa-si-20' . $angkatans[$i] . '" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbSi . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

            $tabelSipil = '<div class="ft-20' . $angkatans[$i] . '" style="display: none;">
                                    <div class="row justify-content-center">
                                        <div class="col-4">
                                            <a id="sipil-20' . $angkatans[$i] . '" class="my-3 btn btn-primary btn-lg btn-block" onClick="toggle(this.id)" style="display: none;">Teknik Sipil</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <div id="mahasiswa-sipil-20' . $angkatans[$i] . '" class="card mb-5 shadow p-2 bg-white rounded" style="display: none;">
                                            ' . $tbSipil . '
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: contents;"></div>
                                    </div>
                                </div>
                                ';

            $akuntansi[] = $tabelAkuntansi;
            $manajemen[] = $tabelManajemen;
            $dkv[] = $tabelDKV;
            $ilkom[] = $tabelIlkom;
            $psikologi[] = $tabelPsikologi;
            $arsitektur[] = $tabelArsitektur;
            $informatika[] = $tabelInformatika;
            $si[] = $tabelSi;
            $industri[] = $tabelIndustri;
            $sipil[] = $tabelSipil;
            // var_dump($akuntansi);die();
        }

        return $this->render('pilihMahasiswa', [
            'akuntansi' => $akuntansi,
            'manajemen' => $manajemen,
            'dkv' => $dkv,
            'ilkom' => $ilkom,
            'psikologi' => $psikologi,
            'arsitektur' => $arsitektur,
            'informatika' => $informatika,
            'si' => $si,
            'industri' => $industri,
            'sipil' => $sipil,
            'message' => $message
            
        ]);
    }

    public function table($data)
    {
        $table = '<table class="mhs">
                    <thead>
                        <tr>
                            <th></th>
                            <th>NIM</th>
                            <th>NAMA MAHASISWA</th>
                            <th>PROGRAM STUDI</th>
                            <th>FAKULTAS</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($data as $dt) {
            $table .=
                '<tr>
                <td><input type="checkbox" value="' . $dt["nim"] . '"></td>
                <td>' . $dt["nim"] . '</td>
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

        $query = 'SELECT nim, nama, nama_prodi AS prodi, nama_fakultas AS fakultas, total_polling 
                FROM mahasiswa m
                JOIN prodi p ON m.prodi = p.kode_prodi
                JOIN fakultas f ON m.fakultas = f.kode_fakultas
                WHERE nim in (' . $data . ')';

        $db = Yii::$app->db;
        $dataPilihan = $db->createCommand($query)->queryAll();
        $table = '<table style="margin:15px auto;">
                    <thead>
                        <tr>
                            <th style="width: 20%;">NIM</th>
                            <th style="width: 30%;">NAMA</th>
                            <th style="width: 30%;">PROGRAM STUDI</th>
                            <th style="width: 20%;">FAKULTAS</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($dataPilihan as $dt) {
            $table .=
                '<tr>
                    <td>' . $dt["nim"] . '</td>
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

    // public function actionPilih()
    // {
    //     $angkatans = [
    //         '15',
    //         '16',
    //         '17',
    //         '18',
    //         '19',
    //         '20',
    //         '21',
    //         '22'
    //     ];

    //     $akuntansi = '44280000';
    //     $manajemen = '44290000';
    //     $dkv = '44110000';
    //     $ilkom = '44120000';
    //     $psikologi = '44130000';
    //     $arsitektur = '44150000';
    //     $informatika = '44190000';
    //     $si = '44180000';
    //     $industri = '44170000';
    //     $sipil = '44160000';


    //     for ($i = 0; $i < count($angkatans); $i++) {
    //         $angs = $angkatans[$i];
    //         for ($j = 0; $j < 100; $j++) {
    //             $query = 'INSERT INTO kampus.dosen
    //                 (nid, nama, prodi, fakultas, total_polling)
    //                 VALUES
    //                 (' . (int)($angs . $akuntansi) + $j . ', "Dosen Akuntansi ' . $this->random_strings(5) . '", "AK1", "FEB", 0)';
    //             $db = Yii::$app->db;
    //             $db->createCommand($query)->queryAll();
    //         }
    //         for ($j = 0; $j < 100; $j++) {
    //             $query = 'INSERT INTO kampus.dosen
    //                 (nid, nama, prodi, fakultas, total_polling)
    //                 VALUES
    //                 (' . (int)($angs . $manajemen) + $j . ', "Dosen Manajemen ' . $this->random_strings(5) . '", "ME1", "FEB", 0)';
    //             $db = Yii::$app->db;
    //             $db->createCommand($query)->queryAll();
    //         }
    //         for ($j = 0; $j < 100; $j++) {
    //             $query = 'INSERT INTO kampus.dosen
    //                 (nid, nama, prodi, fakultas, total_polling)
    //                 VALUES
    //                 (' . (int)($angs . $dkv) + $j . ', "Dosen DKV ' . $this->random_strings(5) . '", "DK1", "FIK", 0)';
    //             $db = Yii::$app->db;
    //             $db->createCommand($query)->queryAll();
    //         }
    //         for ($j = 0; $j < 100; $j++) {
    //             $query = 'INSERT INTO kampus.dosen
    //                 (nid, nama, prodi, fakultas, total_polling)
    //                 VALUES
    //                 (' . (int)($angs . $ilkom) + $j . ', "Dosen Ilkom ' . $this->random_strings(5) . '", "IK1", "FIK", 0)';
    //             $db = Yii::$app->db;
    //             $db->createCommand($query)->queryAll();
    //         }
    //         for ($j = 0; $j < 100; $j++) {
    //             $query = 'INSERT INTO kampus.dosen
    //                 (nid, nama, prodi, fakultas, total_polling)
    //                 VALUES
    //                 (' . (int)($angs . $psikologi) + $j . ', "Dosen Psikologi ' . $this->random_strings(5) . '", "PS1", "FP", 0)';
    //             $db = Yii::$app->db;
    //             $db->createCommand($query)->queryAll();
    //         }
    //         for ($j = 0; $j < 100; $j++) {
    //             $query = 'INSERT INTO kampus.dosen
    //                 (nid, nama, prodi, fakultas, total_polling)
    //                 VALUES
    //                 (' . (int)($angs . $arsitektur) + $j . ', "Dosen Arsitektur ' . $this->random_strings(5) . '", "AR1", "FT", 0)';
    //             $db = Yii::$app->db;
    //             $db->createCommand($query)->queryAll();
    //         }
    //         for ($j = 0; $j < 100; $j++) {
    //             $query = 'INSERT INTO kampus.dosen
    //                 (nid, nama, prodi, fakultas, total_polling)
    //                 VALUES
    //                 (' . (int)($angs . $informatika) + $j . ', "Dosen Informatika ' . $this->random_strings(5) . '", "IF4", "FT", 0)';
    //             $db = Yii::$app->db;
    //             $db->createCommand($query)->queryAll();
    //         }
    //         for ($j = 0; $j < 100; $j++) {
    //             $query = 'INSERT INTO kampus.dosen
    //                 (nid, nama, prodi, fakultas, total_polling)
    //                 VALUES
    //                 (' . (int)($angs . $si) + $j . ', "Dosen SI ' . $this->random_strings(5) . '", "MF4", "FT", 0)';
    //             $db = Yii::$app->db;
    //             $db->createCommand($query)->queryAll();
    //         }
    //         for ($j = 0; $j < 100; $j++) {
    //             $query = 'INSERT INTO kampus.dosen
    //                 (nid, nama, prodi, fakultas, total_polling)
    //                 VALUES
    //                 (' . (int)($angs . $industri) + $j . ', "Dosen Industri ' . $this->random_strings(5) . '", "MI4", "FT", 0)';
    //             $db = Yii::$app->db;
    //             $db->createCommand($query)->queryAll();
    //         }
    //         for ($j = 0; $j < 100; $j++) {
    //             $query = 'INSERT INTO kampus.dosen
    //                 (nid, nama, prodi, fakultas, total_polling)
    //                 VALUES
    //                 (' . (int)($angs . $sipil) + $j . ', "Dosen Sipil ' . $this->random_strings(5) . '", "TS4", "FT", 0)';
    //             $db = Yii::$app->db;
    //             $db->createCommand($query)->queryAll();
    //         }
    //     }
    // }

    // function random_strings($length_of_string)
    // {

    //     // String of all alphanumeric character
    //     $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    //     // Shuffle the $str_result and returns substring
    //     // of specified length
    //     return substr(
    //         str_shuffle($str_result),
    //         0,
    //         $length_of_string
    //     );
    // }

    /**
     * Lists all Mahasiswa models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MahasiswaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
