<?php
namespace frontend\controllers;

use common\api\cms\ArticleApi;
use common\components\CmsPagination;
use common\models\cms\Keyword;
use Yii;
use frontend\components\BaseController;
use common\api\cms\KeywordApi;
use common\models\cms\ArticleModel;
use yii\web\NotFoundHttpException;

class ContentController extends BaseController
{
    public $layout = 'yzpLayout.php';

//    public function behaviors()
//    {
//        return [
//            [
//                'class' => 'yii\filters\PageCache',
//                'only' => ['index'],
//                'duration' => 60,
//                'dependency' => [
//                    'class' => 'yii\caching\DbDependency',
//                    'sql' => 'SELECT COUNT(*) FROM keyword',
//                ],
//            ]
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    //首页
    public function actionIndex($page = 1)
    {
        $query = Keyword::find()->where(['keyword.status' => 1]);

        $pages = new CmsPagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 10,
        ]);

        $lists = $query
            ->select('keyword.id, keyword')
            ->with('firstArticle')
            ->orderBy('keyword.id DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();

        return $this->render('index', compact('lists', 'pages'));
    }

    //列表页
    public function actionList($id = 1, $page = 1, $pinyin = '')
    {
        $id = (int)$id;

        $query = ArticleModel::find()->where(array('keyword_id' => $id, 'status' => 1));
        $countQuery = clone $query;
        $pages = new CmsPagination([
            'totalCount' => $countQuery->count(),
            'params' => [
                'id' => $id,
            ],
            'defaultPageSize' => 5,
        ]);
        /**
         * 如果页数大于总页数，抛出404
         */
        if ($page > 1 && $page > $pages->pageCount) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $category = KeywordApi::getCategoryInfo($id);
        /**
         * 如果url中的拼音不等于关键词的拼间，也抛出异常
         */
        if ($category['pinyin'] !== $pinyin) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

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
        return $this->render('show', compact('data', 'category'));
    }

    /**
     * 随机文章
     */
    public function actionRandom()
    {
        $data = ArticleApi::getRandom();
        return $this->render('random', compact('data'));
    }

    /**
     * 搜索
     */
    public function actionSearch()
    {
        $key = Yii::$app->request->get('keyword', '');

        $this->redirect('http://top.baidu.com/detail?b=1&ie=utf-8&w='.$key);
    }
}
