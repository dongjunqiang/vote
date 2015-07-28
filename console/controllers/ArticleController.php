<?php
/**
 * 采集文章
 * FileName: articleController.php
 * Author: dingwen
 * Date: 2015/07/23 15:16
 */
namespace console\controllers;

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
        foreach (UrlHistoryModel::find()->select('id, keyword_id, copyfrom, url')->where(array('status' => 0))->asArray()->limit(10)->each(10) as $urls) {
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
                    $model->description = StringHelper::truncate($data['content'], 200);
                    $model->copyfrom = $urls['copyfrom'];
                    $model->save();
                    if ($model->id) {
                        $dataModel = new ArticleContentModel();
                        $dataModel->article_id = $model->id;
                        $dataModel->content = $data['content'];
                        $dataModel->save();
                        UrlHistoryModel::updateAll(['status' => 1], array('id' => $urls['id']));
                    }
                } catch (\Exception $e) {
                    \yii::error("文章插入失败\n原因:{$e->getMessage()}\n");
                }
            }
        }
    }
}