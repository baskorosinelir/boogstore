<?php
namespace app\models;

use yii\db\ActiveRecord;

class Teams extends ActiveRecord 
{
    //public $teamsCount;
    public static function tableName()
    {
        return 'teams';
    }

    public function getLeagues()
    {
        return $this->hasOne(Leagues::className(), ['id'=> 'leagues_id']);
    }
}