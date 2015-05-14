<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%option}}".
 *
 * @property string $id
 * @property string $vote_id
 * @property string $name
 * @property string $count
 * @property string $add_time
 * @property string $modify_time
 */
class VoteOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%option}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vote_id', 'name', 'modify_time'], 'required'],
            [['vote_id', 'count'], 'integer'],
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
            'id' => '选项id',
            'vote_id' => '活动id',
            'name' => '选项名',
            'count' => '投票数量',
            'add_time' => '添加时间',
            'modify_time' => '修改时间',
        ];
    }
}
