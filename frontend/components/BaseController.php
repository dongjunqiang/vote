<?php
namespace frontend\components;

use Yii;
use yii\helpers\Html;
use yii\web\Controller;

class BaseController extends Controller
{
	public function ajaxOut($list, $status = 1){
        $data = ['list' => $list, 'status' => (int)$status];
		echo isset($_GET['callback']) ? Html::encode($_GET['callback']).'('. json_encode($data, JSON_UNESCAPED_UNICODE).')' : json_encode($data, JSON_UNESCAPED_UNICODE);
		exit;
	}
}