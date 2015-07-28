<?php

namespace common\models\cms;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $title
 * @property string $keyword
 * @property string $picture
 * @property string $description
 * @property integer $sort
 * @property integer $status
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['sort', 'status'], 'integer'],
            ['sort', 'default', 'value' => 0],
            [['title', 'keyword', 'picture', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '栏目名称',
            'keyword' => '栏目关键词',
            'picture' => '图片',
            'description' => '描述',
            'sort' => '排序',
            'status' => '状态',
        ];
    }
}
