<?php
use yii\widgets\ActiveForm;

?>
<style>
    .table .control-label {width:100px;}
</style>
<?php $form = ActiveForm::begin([
    'id' => 'j_custom_form',
    'method' => 'post',
    'enableClientScript' => false,
    'enableClientValidation' => false,
    'options' => [
        'data-toggle' => 'validate',
        'data-alertmsg' => 'false'
    ],
]);?>
<div class="bjui-pageContent">
    <table class="table table-condensed table-hover" width="100%">
        <tbody>
            <tr>
                <td><?= $form->field($model, 'title')->textInput()->label('栏目名称：')?></td>
            </tr>
            <tr>
                <td><?= $form->field($model, 'keyword')->textInput()->label('关键词：')?></td>
            </tr>
            <tr>
                <td><?= $form->field($model, 'description')->textInput()->label('描述：')?></td>
            </tr>
            <tr>
                <td><?= $form->field($model, 'picture')->textInput()->label('图片：')?></td>
            </tr>
            <tr>
                <td><?= $form->field($model, 'sort')->textInput()->label('排序：')?></td>
            </tr>
        </tbody>
    </table>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close" data-icon="close">取消</button></li>
        <li><button type="submit" class="btn-default" data-icon="save">保存</button></li>
    </ul>
</div>
<?php ActiveForm::end(); ?>