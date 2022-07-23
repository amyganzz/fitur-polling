<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property int $nim
 * @property string|null $nama
 * @property string|null $prodi
 * @property int|null $total_polling
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mahasiswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nim'], 'required'],
            [['nim', 'total_polling'], 'integer'],
            [['nama', 'prodi'], 'string', 'max' => 64],
            [['nim'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nim' => 'Nim',
            'nama' => 'Nama',
            'prodi' => 'Prodi',
            'total_polling' => 'Total Polling',
        ];
    }
}
