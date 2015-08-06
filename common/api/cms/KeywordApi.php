<?php
/**
 * FileName: KeywordApi.php
 * Author: dingwenhua
 * Date: 2015/07/31 10:22
 */
namespace common\api\cms;

use common\models\cms\HitsModel;
use Yii;
use common\models\cms\Keyword;
use yii\helpers\ArrayHelper;

class KeywordApi
{
    const CACHE_KEY = 'newCategory';
    /**
     * 从最近100条读，不存在则从数据库中读取，并添加到缓存
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getCategoryInfo($id)
    {
        $categorys = self::getCategorys();
        if (isset($categorys[$id])) {
            return $categorys[$id];
        }
        $data = Keyword::find()->select('id, keyword, pinyin, news_count, status, add_time')->where(array('id' => $id, 'status' => 1))->asArray()->one();
        self::addCache($categorys, $data);
        return $data;
    }

    /**
     * 获取最近的100条的关键词
     */
    public static function getCategorys()
    {
        $cacheObject = Yii::$app->cache;
        if (false === ($cache = $cacheObject->get(self::CACHE_KEY))) {
            $cache = Keyword::find()->select('id, keyword, pinyin, news_count, status, add_time')
                ->where(array('status' => 1))
                ->orderBy('id DESC')->limit(100)->asArray()->all();
            if ($cache) {
                $cache = ArrayHelper::index($cache, 'id');
                $cacheObject->set(self::CACHE_KEY, $cache, 7200);
            }
        }
        return $cache;
    }

    /**
     * 获取热门关键词
     * @param int $num 数量
     * @param string $order 排序规则
     */
    public static function getHotKeywords($num = 10, $order = 'views')
    {
        $from = $order == 'views' ? 'hits force INDEX(i_views)' : 'hits force INDEX(i_month)';
        return HitsModel::find()->select('kid')->from($from)->where(['aid' => 0])->orderBy([$order => SORT_DESC])->with('keywordInfo')->asArray()->limit($num)->all();
    }

    private static function addCache($category, $data)
    {
        if (!isset($data['id'])) {
            return $category;
        }
        $category[$data['id']] = $data;
        Yii::$app->cache->set(self::CACHE_KEY, $category);
    }
}
