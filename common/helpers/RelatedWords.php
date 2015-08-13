<?php
/**
 * 长尾词获取
 * FileName: relatedWords.php
 * Author: dingwenhua
 * Date: 2015/08/04 15:51
 */
namespace common\helpers;

class RelatedWords
{
    const API_URL = 'http://api.kun8.com/ciku/xiangguanci.php?type=json&word=';

    public static function getWords($key, $num = 5)
    {
        try {
            $num = (int)$num;
            $url = self::API_URL . $key;
            $data = file_get_contents($url);
            if ($data) {
                $data = json_decode($data, true);
                return $data ? array_slice($data, 0, $num) : $data;
            }
            return [];
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
            return [];
        }
    }

    public static function getWordsByCache($key, $num = 5)
    {
        if (false == $data = \Yii::$app->cache->get($key.$num)) {
            $data = self::getWords($key, $num);
            if ($data) {
                \Yii::$app->cache->set($key.$num, $data, 600);
            }
        }
        return $data;
    }
}
