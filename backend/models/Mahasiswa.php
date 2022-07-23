<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property int $nim
 * @property string|null $nama
 * @property string|null $prodi
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
            [['nim'], 'integer'],
            [['nama'], 'string', 'max' => 64],
            [['prodi'], 'string', 'max' => 32],
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
        ];
    }
}
