<?php
/**
 * 采集文章
 * FileName: articleController.php
 * Author: dingwen
 * Date: 2015/07/23 15:16
 */
namespace console\controllers;

use common\components\Attachment;
use common\models\cms\ArticleContentModel;
use common\models\cms\ArticleModel;
use common\models\cms\UrlHistoryModel;
use yii\base\Exception;
use yii\helpers\StringHelper;

class ArticleController extends \yii\console\Controller
{
    const API_URL = 'http://dingwenhua.sinaapp.com/collection.php?url=';

    public function actionIndex()
    {
        self::collect();
    }

    public function actionCollectByKeywordId($keywordId)
    {
        $where = ['keyword_id' => $keywordId, 'status' => 0];
        self::collect($where);
    }

    private static function collect($where = [])
    {
        if (!$where) {
            $where = ['status' => 0];
        }
        foreach (UrlHistoryModel::find()->select('id, keyword_id, copyfrom, url')->where($where)->orderBy('id DESC')->asArray()->limit(100)->each(10) as $urls) {
            $data = file_get_contents(self::API_URL.$urls['url']);
            if ($data) {
                $data = json_decode($data, true);
                if (!$data['title'] || !$data['content']){
                    UrlHistoryModel::updateAll(['status' => 1], array('id' => $urls['id']));
                    continue;
                }
                try {
                    $model = new ArticleModel();
                    $model->title = $data['title'];
                    $model->keyword_id = $urls['keyword_id'];
                    $model->description = StringHelper::truncate(str_replace(array("'","\r\n","\t",'&ldquo;','&rdquo;','&nbsp;'), '', strip_tags($data['content'])), 200);
                    $model->copyfrom = $urls['copyfrom'];

                    $content = Attachment::downloadThumb($data['content']);
                    $thumb = self::getFirstPic($content);
                    if (Attachment::checkPicWidth($thumb)) {
                        $model->thumb = $thumb;
                    }

                    $model->save();

                    if ($model->id) {
                        $dataModel = new ArticleContentModel();
                        $dataModel->article_id = $model->id;
                        $dataModel->content = $content;
                        $dataModel->save();
                        UrlHistoryModel::updateAll(['status' => 1], array('id' => $urls['id']));
                    }
                } catch (\Exception $e) {
                    \yii::error("文章插入失败\n原因:{$e->getMessage()}\n");
                }
            }
        }
    }

    private static function getFirstPic($content)
    {
        if (preg_match("/(src)=([\"|']?)([^ \"'>]+\.(gif|jpg|jpeg|bmp|png))\\2/i", $content, $match)) {
            return $match[3];
        }
    }
}