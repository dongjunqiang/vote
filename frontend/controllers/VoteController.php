<?php
namespace frontend\controllers;

use common\models\VoteLog;
use Yii;
use frontend\components\BaseController;
use common\models\VoteCategory;

class VoteController extends BaseController
{
    //首页
	public function actionIndex(){
		$data = VoteCategory::find()->asArray()->all();
		return $this->render('index.tpl', compact('data'));
	}

    //列表页
	public function actionList($id = 1){
        $data = VoteCategory::find()
            ->select('id, name')
            ->where('id = :id', array(':id' => $id))
            ->with('voteOption')
            ->asArray()
            ->one();
		return $this->render('list.tpl', compact('data'));
	}

    //点赞并留言
    public function actionVote(){
        $model = new VoteLog();
        $post = Yii::$app->request->post();
        $post['voteLog']['user_id'] = Yii::$app->user->id ? Yii::$app->user->id : 0;
        if( $model->load($post, 'voteLog') && $model->save() ){
            Yii::$app->session->setFlash('success', '投票成功');
        }else{
            Yii::$app->session->setFlash('error', $model->getFirstErrors());
        }
        $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * 显示详细
     * @param $id option_id 投票选项id
     */
    public function actionDetail($id){
        //if(Yii::$app->request->isAjax){
            $data = VoteLog::find()
                ->select('user_id, message, add_time')
                ->where('option_id = :id', array('id' => $id))
                ->asArray()->all();
            foreach($data as &$d){
                $d['username'] = $d['user_id'] ? $d['user_id'] : '匿名';
            }
            $this->ajaxOut($data);
        //}
    }
}