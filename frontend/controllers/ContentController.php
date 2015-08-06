<?php
namespace frontend\controllers;

use common\api\cms\ArticleApi;
use common\components\CmsPagination;
use common\helpers\RelatedWords;
use Yii;
use frontend\components\BaseController;
use common\api\cms\KeywordApi;
use common\models\cms\ArticleModel;
use yii\data\Pagination;

class ContentController extends BaseController
{
    public $layout = 'yzpLayout.php';

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 60,
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT(*) FROM keyword',
                ],
            ]
        ];
    }

    //首页
    public function actionIndex()
    {
        return $this->render('index');
    }

    //列表页
    public function actionList($id = 1, $page = 1)
    {
        $id = (int)$id;
        $category = KeywordApi::getCategoryInfo($id);
        $query = ArticleModel::find()->where(array('keyword_id' => $id, 'status' => 1));
        $countQuery = clone $query;
        $pages = new CmsPagination([
            'totalCount' => $countQuery->count(),
            'params' => [
                'id' => $id,
            ],
            'defaultPageSize' => 10,
        ]);

        $pages->setPage((int)$page - 1);

        $lists = $query
            ->select('id, title, thumb, description, copyfrom, add_time')
            ->orderBy('id DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
        return $this->render('list', compact('id','lists','category', 'pages'));
    }

    //内容页
    public function actionShow($id)
    {
        $data = ArticleModel::find()->where(['id' => $id, 'status' => 1])->with('content')->asArray()->one();
        $category = KeywordApi::getCategoryInfo($data['keyword_id']);

        //获取相关词
        //$relates = RelatedWords::getWords($category['keyword']);
//        var_dump($relates);

        //$articles = ArticleApi::getRelatedArticles($data['keyword_id']);
        //var_dump($articles);

        return $this->render('show', compact('data', 'category'));
    }
}
