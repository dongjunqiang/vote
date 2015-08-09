<?php
use \Yii;
use \yii\helpers\StringHelper;
use frontend\components\CommonHelper;
?>
<?php $baseUrl = Yii::$app->getView()->theme->baseUrl;?>
<nav id="mbx">当前位置：<a href="<?=Yii::$app->params['webUrl']?>">首页</a> &gt; <a href="<?=CommonHelper::getCategoryUrl($id)?>"><?=$category['keyword']?></a></nav>
<?php if ($lists):?>
    <?php foreach ($lists as $list):?>
        <?php $url = CommonHelper::getArticleUrl($id, $list['id']);?>
    <section class="archive-list">
        <div class="titleimg">
            <a href="<?=$url?>">
                <img width="270" height="165" src="<?php echo $list['thumb'] ? $list['thumb'] : $baseUrl.'/images/default.png'; ?>" class="attachment-thumbnail wp-post-image" alt="<?=\yii\helpers\Html::encode($list['title'])?>" />
            </a>
        </div>
        <div class="mecc">
            <h2 class="mecctitle"> <a href="<?=$url?>"><?=$list['title']?></a> </h2>
            <address class="meccaddress">
                <time><?=date('m.d', strtotime($list['add_time']))?></time>
                -
                <span><?=$list['copyfrom']?></span>        -
                <?=$category['keyword']?>
            </address>
            <p><?=StringHelper::truncate($list['description'], 130)?></p>
        </div>
        <div class="clear"></div>
    </section>
    <div class="clear"></div>
    <?php endforeach;?>
    <!--list-->
<?php else:?>
    <section class="archive-list"></section>
<?php endif;?>
<!--Page-->
<?php echo \yii\widgets\LinkPager::widget([
    'pagination' => $pages,
    'options' => [
        'class' => 'pagenavi'
    ],
    'linkOptions' => [
        'class' => 'page-numbers',
    ]
])?>
<!--Page End-->
<script src="<?=\yii\helpers\Url::to(['api/count', 'keywordId'=>$id])?>"></script>
