<?php
namespace backend\controllers;

use \yii;
use \yii\web\Controller;
use \common\models\cms\Category;

class CategoryController extends SiteController
{
    public function actionIndex()
    {
        $model = new Category();
        if ($model->load(yii::$app->request->post())) {
            if ($model->save()) {
                return $this->ajaxOut();
            } else {
                return $this->ajaxOut(current($model->getFirstErrors()), 300);
            }
        }
        return $this->render('index', compact('model'));
    }
}
