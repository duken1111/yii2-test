<?php

namespace app\models;

use app\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property string $name Наименования товара
 * @property string|null $description Описание товара
 * @property string $production_date Дата изготовления товара
 * @property int $created_at Дата создания
 * @property int $updated_at Дата изменения
 *
 * @property array $prices
 */
class Product extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function afterFind()
    {
        parent::afterFind();

        $this->production_date = Yii::$app->formatter->asDate($this->production_date);
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function beforeSave($insert)
    {
        $this->production_date = Yii::$app->formatter->asDatetime($this->production_date, 'Y-M-d');

        return parent::beforeSave($insert);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::class, ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivePrices()
    {
        return $this->getPrices()->where(['IS NOT', 'price', null])->andWhere(['>', 'price', 0]);
    }

    /**
     * @param $attributes
     * @return bool
     */
    public function addPrice($attributes)
    {
        return (new Price($attributes))->save();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'production_date'], 'required'],
            [['production_date'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['description'], 'string', 'max' => 1500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименования товара',
            'description' => 'Описание товара',
            'production_date' => 'Дата изготовления товара',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'prices' => 'Цены',
        ];
    }
}
