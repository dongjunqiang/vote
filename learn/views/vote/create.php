<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model learn\models\Vote */

$this->title = '创建一个刷票的数据';
$this->params['breadcrumbs'][] = ['label' => 'Votes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vote-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
