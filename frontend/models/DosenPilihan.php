<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dosen_pilihan".
 *
 * @property int $dp_id
 * @property string|null $dp_nama
 * @property int|null $created_by
 * @property string|null $created_at
 *
 * @property Mahasiswa $createdBy
 */
class DosenPilihan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dosen_pilihan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['dp_nama'], 'string', 'max' => 64],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['created_by' => 'nim']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dp_id' => 'Dp ID',
            'dp_nama' => 'Dp Nama',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Mahasiswa::className(), ['nim' => 'created_by']);
    }
}
