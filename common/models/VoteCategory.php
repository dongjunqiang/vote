<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $name
 * @property string $add_time
 * @property string $modify_time
 */
class VoteCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['add_time', 'modify_time'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '活动id',
            'name' => '活动名称',
            'add_time' => '添加时间',
            'modify_time' => '添加时间',
        ];
    }

    public function getVoteOption(){
        return $this->hasMany(VoteOption::className(), ['vote_id' => 'id'])
            ->select(['id', 'vote_id', 'name', 'count'])
            ->orderBy('count desc');
    }
}
