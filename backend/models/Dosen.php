<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dosen".
 *
 * @property int $nid
 * @property string $nama
 * @property string $prodi
 * @property string $fakultas
 * @property int $total_polling
 *
 * @property Fakultas $fakultas0
 * @property Prodi $prodi0
 */
class Dosen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dosen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nid', 'nama', 'prodi', 'fakultas'], 'required'],
            [['nid', 'total_polling'], 'integer'],
            [['nama'], 'string', 'max' => 64],
            [['prodi', 'fakultas'], 'string', 'max' => 100],
            [['nid'], 'unique'],
            [['prodi'], 'exist', 'skipOnError' => true, 'targetClass' => Prodi::className(), 'targetAttribute' => ['prodi' => 'kode_prodi']],
            [['fakultas'], 'exist', 'skipOnError' => true, 'targetClass' => Fakultas::className(), 'targetAttribute' => ['fakultas' => 'kode_fakultas']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nid' => 'Nid',
            'nama' => 'Nama',
            'prodi' => 'Prodi',
            'fakultas' => 'Fakultas',
            'total_polling' => 'Total Polling',
        ];
    }

    /**
     * Gets query for [[Fakultas0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFakultas0()
    {
        return $this->hasOne(Fakultas::className(), ['kode_fakultas' => 'fakultas']);
    }

    /**
     * Gets query for [[Prodi0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdi0()
    {
        return $this->hasOne(Prodi::className(), ['kode_prodi' => 'prodi']);
    }
}
