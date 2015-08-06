<?php
/**
 * FileName: ApiController.php
 * Author: dingwenhua
 * Date: 2015/08/05 23:05
 */
namespace frontend\controllers;

use common\models\cms\HitsModel;
use frontend\components\BaseController;

class ApiController extends BaseController
{
    public $layout = 'yzpLayout.php';

    public function actionCount()
    {
        $keywordId = \Yii::$app->request->get('keywordId', 0);
        $articleId = \Yii::$app->request->get('articleId', 0);

        if (!$keywordId) {
            exit;
        }

        $data = HitsModel::addHits($keywordId, $articleId);
        $this->ajaxOut($data);
        //$data = HitsModel::find()->select('views, month_views')->where(['kid' => $keywordId, 'aid' => $articleId])->asArray()->one();
    }
}