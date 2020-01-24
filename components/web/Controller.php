<?php


namespace app\components\web;

use yii\db\ActiveQuery;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class Controller extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['post']
                ]
            ],
        ];
    }


    /**
     * @param $class
     * @param $id
     * @param null $with
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected function findModel($class, $id, $with = null)
    {
        /**
         * @var $query ActiveQuery
         */
        $query = $class::find();

        if ($with) {
            $query->with($with);
        }

        $model = $query->where(['id' => $id])->limit(1)->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}