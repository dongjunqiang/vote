<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel learn\models\VoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Votes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vote-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建刷票', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'url:url',
            'type',
            //'params:ntext',
            'total_votes',
            'has_votes',
            'add_time',
            //'modify_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
