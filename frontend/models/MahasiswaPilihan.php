<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mahasiswa_pilihan".
 *
 * @property int $mp_id
 * @property string|null $mp_nama
 * @property int|null $mp_nim
 * @property string|null $created_at
 * @property string|null $created_by
 *
 * @property Mahasiswa $mpNim
 */
class MahasiswaPilihan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mahasiswa_pilihan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mp_nim'], 'integer'],
            [['created_at'], 'safe'],
            [['mp_nama', 'created_by'], 'string', 'max' => 64],
            [['mp_nim'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['mp_nim' => 'nim']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mp_id' => 'Mp ID',
            'mp_nama' => 'Mp Nama',
            'mp_nim' => 'Mp Nim',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[MpNim]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMpNim()
    {
        return $this->hasOne(Mahasiswa::className(), ['nim' => 'mp_nim']);
    }
}
