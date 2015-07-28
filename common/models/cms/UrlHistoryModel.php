<?php

namespace common\models\cms;

use Yii;

/**
 * This is the model class for table "url_history".
 *
 * @property string $id
 * @property string $keyword_id
 * @property string $url
 * @property string $md5
 * @property integer $status
 */
class UrlHistoryModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'url_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword_id', 'url', 'md5'], 'required'],
            [['keyword_id', 'status'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['md5'], 'string', 'max' => 32],
            [['md5'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword_id' => '关键词id',
            'url' => '链接',
            'md5' => 'Md5',
            'status' => '状态：0=未采,1=已采',
        ];
    }
}
