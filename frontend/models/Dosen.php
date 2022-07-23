<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dosen".
 *
 * @property int $nid
 * @property string|null $nama
 * @property int|null $total_polling
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
            [['nid'], 'required'],
            [['nid', 'total_polling'], 'integer'],
            [['nama'], 'string', 'max' => 64],
            [['nid'], 'unique'],
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
            'total_polling' => 'Total Polling',
        ];
    }
}
