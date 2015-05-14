<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model learn\models\Vote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'placeholder'=>'例：http://www.baidu.com']) ?>

    <?php $model->type = $model->isNewRecord ? 0 : $model->type;?>
    <?= $form->field($model, 'type')->radioList([0=>'get',1=>'post']) ?>

    <?= $form->field($model, 'params')->textarea(['rows' => 6, 'placeholder'=>'例：username=ian&password=hua']) ?>

    <?php $model->fake_ip = $model->isNewRecord ? 0 : $model->fake_ip;?>
    <?= $form->field($model, 'fake_ip')->radioList([0=>'否', 1=>'是']) ?>

    <?= $form->field($model, 'total_votes')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
