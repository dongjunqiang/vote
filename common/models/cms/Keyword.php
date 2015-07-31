<?php

namespace common\models\cms;

/**
 * This is the model class for table "keyword".
 *
 * @property string $id
 * @property string $keyword
 * @property string $md5
 * @property string $pinyin
 * @property string $news_count
 * @property integer $status
 * @property string $add_time
 */
class Keyword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keyword';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword', 'md5'], 'required'],
            [['news_count', 'status'], 'integer'],
            [['add_time'], 'safe'],
            [['keyword', 'pinyin'], 'string', 'max' => 255],
            [['md5'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword' => '关键词',
            'md5' => 'Md5',
            'pinyin' => '拼音',
            'news_count' => '新闻数',
            'status' => '采集状态
0=未采集
1=已采集',
            'add_time' => '添加时间',
        ];
    }
}
