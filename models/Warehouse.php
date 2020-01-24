<?php

namespace app\models;

use app\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%warehouse}}".
 *
 * @property int $id
 * @property string $name Наименования склада
 * @property int $code Код склада
 * @property int $created_at Дата создания
 * @property int $updated_at Дата изменения
 */
class Warehouse extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%warehouse}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['code', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименования склада',
            'code' => 'Код склада',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }
}
