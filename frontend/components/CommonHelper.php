<?php
/**
 * Path: CommonHelper.php
 * Author: dingwen
 * Date: 2015/8/8 0008
 * Time: 22:07
 */
namespace frontend\components;

use common\api\cms\KeywordApi;

class CommonHelper
{
    public static function getCategoryUrl($keywordId, $page = 1, $absolute = true)
    {
        $category = KeywordApi::getCategoryInfo($keywordId);
        $url = '/'.$category['pinyin'].'/list_'.(int)$keywordId. ($page > 1 ? '_'.(int)$page : '') .'.html';
        return $absolute ? \Yii::$app->params['webUrl'].$url : $url;
    }

    public static function getArticleUrl($keywordId, $articleId, $absolute = true)
    {
        $category = KeywordApi::getCategoryInfo($keywordId);
        $url = '/'.$category['pinyin'].'/show_'.$articleId.'.html';
        return $absolute ? \Yii::$app->params['webUrl'].$url : $url;
    }
}