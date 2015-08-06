<?php
/**
 * FileName: Attachment.php
 * Author: dingwenhua
 * Date: 2015/08/03 10:07
 */
namespace common\components;

use common\helpers\Dir;
use Yii;

class Attachment
{
    /**
     * 图片的最小宽度
     */
    const MIN_WIDTH = 100;

    /**
     * 下载缩略图
     * @param $value
     * @param string $ext
     * @return mixed
     */
    public static function downloadThumb($value, $ext = 'gif|jpg|jpeg|bmp|png')
    {
        if (preg_match("/(src)=([\"|']?)([^ \"'>]+\.($ext))\\2/i", $value, $match)) {
            $oldPath = $match[3];
            $fileExt = $match[4];

            $newPath = self::save($oldPath, $fileExt);

            if ($oldPath == $newPath) {
                return $value;
            } else {
                return str_replace($oldPath, $newPath, $value);
            }
        }
        return $value;
    }

    private static function save($url, $fileExt)
    {
        // Create a stream
        $opts = array(
            'http'=>array(
                'method'=> "GET",
                'header'=> "User-Agent:: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.125 Safari/537.36\r\n"
                    . "Referer: $url\r\n"
            )
        );
        $context = stream_context_create($opts);
        $dir = date('Ym/d/');
        $fileName = self::getRandomName($fileExt);
        $fileRoot = Yii::$app->params['uploadPath'].$dir;

        Dir::dirCreate($fileRoot);
        $filePath = $fileRoot.$fileName;
        $uploadUrl = Yii::$app->params['uploadUrl'].$dir.$fileName;

        $file = file_get_contents($url, false, $context);
        if ($file) {
            file_put_contents($filePath, $file);
            return $uploadUrl;
        } else {
            return $url;
        }
    }

    public static function checkPicWidth($pic)
    {
        $info = getimagesize($pic);
        return !!(isset($info[0]) && $info[0] > self::MIN_WIDTH);
    }

    public static function getRandomName($fileExt)
    {
        return date('Ymdhis').rand(100, 999).'.'.$fileExt;
    }
}
