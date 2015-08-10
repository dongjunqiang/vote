<?php
/**
 * FileName: ArticleApi.php
 * Author: dingwenhua
 * Date: 2015/08/04 16:47
 */
namespace common\api\cms;

use common\models\cms\ArticleModel;
use common\models\cms\HitsModel;

class ArticleApi
{
    /**
     * 获取相关文章
     * @param integer $keywordId  关键词id
     * @param integer $num 数量
     */
    public static function getRelatedArticles($keywordId, $num = 4)
    {
        $ids = ArticleModel::find()->select('id')->from('article force INDEX(i_keyword)')->where(array('keyword_id' => $keywordId, 'status' => 1))->asArray()->all();
        if (!$ids) {
            return false;
        }
        shuffle($ids);
        $ids = array_slice($ids, 0, $num);
        return ArticleModel::find()->select('id,keyword_id,title,thumb')->where(array('id' => $ids))->asArray()->all();
    }

    /**
     * 获取文章的上一篇
     * @param $articleId
     */
    public static function getPrevArticle($articleId)
    {
        $data = ArticleModel::find()->select('id, title')->where(['<', 'id', $articleId])->andWhere(['status' => 1])->orderBy('id DESC')->asArray()->one();
        return $data ?: '没有了';
    }

    /**
     * 获取文章的下一篇
     * @param $articleId
     */
    public static function getNextArticle($articleId)
    {
        $data = ArticleModel::find()->select('id, title')->where(['>', 'id', $articleId])->andWhere(['status' => 1])->orderBy('id ASC')->asArray()->one();
        return $data ?: '没有了';
    }

    /**
     * 获取热门文章
     * @param int $num
     * @param string $order
     * @return mixed
     */
    public static function getHotArticle($num = 10, $order = 'views')
    {
        $from = $order == 'views' ? 'hits force INDEX(i_views)' : 'hits force INDEX(i_month)';
        return HitsModel::find()->select('aid')->from($from)->where('aid != 0')->orderBy([$order => SORT_DESC])->with('articleInfo')->asArray()->limit($num)->all();
    }

    /**
     * 获取随机文章
     * @param int $num
     */
    public static function getRandom($num = 10)
    {
        $sql = 'SELECT t1.id,title,keyword_id,thumb,copyfrom,description,t1.add_time,k.keyword
          FROM article t1
          JOIN (SELECT round(RAND() * (SELECT MAX(id) FROM article)) AS nid FROM article where status = 1 LIMIT :num) t2
            ON t1.id = t2.nid
          LEFT JOIN keyword as k ON t1.keyword_id = k.id';
        return ArticleModel::findBySql($sql, [':num' => $num])->asArray()->all();
    }
}