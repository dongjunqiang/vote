<?php

namespace common\models\cms;

use Yii;

/**
 * This is the model class for table "hits".
 *
 * @property string $id
 * @property string $kid
 * @property string $aid
 * @property string $views
 * @property string $month_views
 */
class HitsModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hits';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kid'], 'required'],
            [['kid', 'aid', 'views', 'month_views'], 'integer'],
            //[['kid', 'aid', 'month_views'], 'unique', 'targetAttribute' => ['kid', 'aid', 'month_views'], 'message' => 'kid, aid, month_views的唯一索引存在了'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kid' => 'keyword的id',
            'aid' => '文章的id',
            'views' => '浏览数',
            'month_views' => '本月浏览数',
        ];
    }

    public function getKeywordInfo()
    {
        return $this->hasOne(Keyword::className(), ['id' => 'kid']);
    }

    /**
     * 添加统计
     * @param $keywordId
     * @param int $articleId
     * @return bool
     */
    public static function addHits($keywordId, $articleId = 0)
    {
        if (false == $data = self::find()->where(['kid' => $keywordId, 'aid' => $articleId])->one()) {
            $hits = new self();
            $hits->kid = $keywordId;
            $hits->aid = $articleId;
            $hits->views = $hits->month_views = 1;

            $hits->save();
            return ['views' => 1, 'month_views' => 1];
        } else {
            $data->updateCounters(['views'=>1, 'month_views'=>1]);

            return ['views' => $data->views, 'month_views' => $data->month_views];
        }
    }
}
