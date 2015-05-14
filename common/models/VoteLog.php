<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property string $id
 * @property string $option_id
 * @property string $user_id
 * @property string $message
 * @property string $ip
 * @property string $add_time
 * @property string $modify_time
 */
class VoteLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option_id'], 'required'],
            [['option_id', 'user_id'], 'integer'],
            //[['user_id'], 'validateUserRepeat'],
            [['message'], 'string'],
            [['add_time', 'modify_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'option_id' => '选项id',
            'user_id' => '用户id',
            'message' => 'Message',
            'ip' => 'ip',
            'add_time' => '添加时间',
            'modify_time' => '修改时间',
        ];
    }

    public function validateUserRepeat(){
        $exists = self::find()
            ->where(
                'option_id = :option_id and user_id = :user_id',
                array(':option_id' => $this->option_id, ':user_id' => $this->user_id)
            )->exists();
        if($exists){
            $this->addError('user_id', '亲，您已经投过这个了，换个姿势再来吧!');
        }
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if(!$this->getIsNewRecord()) {
                $this->modify_time = date('Y-m-d H:i:s');
            }else{
                $this->ip = Yii::$app->request->getUserIP();
                $this->message = $this->message ? $this->message : '-_-!! 他啥也没写';
            }
            return true;
        }else{
            return false;
        }
    }

    /**
     * 保存成功后，更新option表里的count字段
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);
        if($insert){
            $model = VoteOption::findOne($this->option_id);
            return $model->updateCounters(['count' => 1]);
        }
    }
}
