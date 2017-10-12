<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Teams;

class HelloDatabaseController extends Controller 
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $query1 = (new \yii\db\Query())
                    ->select(['*'])
                    ->from('teams')
                    ->all();
        $query2 = (new \yii\db\Query())
                    ->select(['id','name','country'])
                    ->from('teams')
                    ->limit(5)
                    ->all();
        $query3 = (new \yii\db\Query())
                    ->select(['*'])
                    ->from('teams')
                    ->where(['country' => 'England'])
                    ->all();
        $query4 = (new \yii\db\Query())
                    ->select(['*'])
                    ->from('teams')
                    ->where(['like','description', 'sebut'])
                    ->orderBy('name')
                    ->all();
        $query5 = (new \yii\db\Query())
                    ->select(['country', 'count(country) as "total"'])
                    ->from('teams')
                    ->groupBy('country')
                    ->orderBy(['total' => SORT_DESC])
                    ->all();

        return $this->render('query-builder-index',[
                    'query1' => $query1,
                    'query2' => $query2,
                    'query3' => $query3,
                    'query4' => $query4,
                    'query5' => $query5,
                    ]);
    } 


    public function actionDemoActiveQueryIndex()
    {
        $query1 = Teams::find()->all();
        
                $query2 = Teams::find()->select(['id', 'name', 'country'])->limit(7)->all();
        
                $query3 = Teams::find()
                                ->where(['country' => 'Indonesia'])
                                ->orderBy('name')
                                ->all();
        
                $query4 = Teams::find()
                            ->where(['like', 'description', 'dolor'])
                            ->orderBy('name')
                            ->all();
        
                $query5 = Teams::find()
                            ->select(['country', 'COUNT(country) as teamsCount'])
                            ->groupBy('country')
                            ->orderBy(['teamsCount' => SORT_DESC])
                            ->all();
        
                return $this->render('activerecord-index', [
                                                                'query1'=>$query1, 
                                                                'query2'=>$query2,
                                                                'query3'=>$query3,
                                                                'query4'=>$query4,
                                                                'query5'=>$query5,
                                                            ]);
    }
}