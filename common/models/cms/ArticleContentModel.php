<?php

namespace common\models\cms;

use Yii;

/**
 * This is the model class for table "article_content".
 *
 * @property string $id
 * @property string $article_id
 * @property string $content
 */
class ArticleContentModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'content'], 'required'],
            [['article_id'], 'integer'],
            [['content'], 'string'],
            [['article_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => '文章id',
            'content' => '正文',
        ];
    }
}
