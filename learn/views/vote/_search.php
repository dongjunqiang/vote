<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VoteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vote-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'params') ?>

    <?= $form->field($model, 'total_votes') ?>

    <?php // echo $form->field($model, 'has_votes') ?>

    <?php // echo $form->field($model, 'add_time') ?>

    <?php // echo $form->field($model, 'modify_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
