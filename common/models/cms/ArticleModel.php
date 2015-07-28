<?php

namespace common\models\cms;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property string $id
 * @property string $keyword_id
 * @property string $title
 * @property string $description
 * @property string $copyfrom
 * @property string $add_time
 */
class ArticleModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword_id', 'title'], 'required'],
            [['keyword_id'], 'integer'],
            [['add_time'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['copyfrom'], 'string', 'max' => 15]
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
            'title' => '标题',
            'description' => '描述',
            'copyfrom' => '来源',
            'add_time' => '添加时间',
        ];
    }
}
