<?php

namespace learn\models;

use Yii;

/**
 * This is the model class for table "vote".
 *
 * @property string $id
 * @property string $url
 * @property integer $type
 * @property string $params
 * @property integer $total_votes
 * @property integer $has_votes
 * @property string $add_time
 * @property string $modify_time
 */
class Vote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vote';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('voteDb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type','total_votes','fake_ip'], 'integer'],
            [['url', 'params'], 'required'],
            [['type','fake_ip'], 'in', 'range' => [0,1]],
            [['params'], 'string'],
            [['add_time', 'modify_time'], 'safe'],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => '网址',
            'type' => '传输方式',
            'params' => '传递参数',
            'fake_ip' => '是否虚拟ip',
            'total_votes' => '总共要投的次数',
            'has_votes' => '已经投过的次数',
            'add_time' => '添加时间',
            'modify_time' => '修改时间',
        ];
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if(!$insert){
                $this->modify_time = date('Y-m-d H:i:s');
            }
            return true;
        }else{
            return false;
        }
    }
}
