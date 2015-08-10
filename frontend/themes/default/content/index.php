<?php
use \Yii;
use \yii\helpers\StringHelper;
use frontend\components\CommonHelper;
?>
<?php foreach ($lists as $list):?>
    <?php $catUrl = CommonHelper::getCategoryUrl($list['id'])?>
    <section class="list">
        <h2><a href="<?=$catUrl?>" target="_blank"><?=$list['keyword']?></a></h2>
        <div class="clear"></div>
        <span class="titleimg">
            <a href="<?=$catUrl?>" target="_blank">
                <img width="270" height="165" src="<?php echo $list['firstArticle']['thumb'] ?: Yii::$app->params['webUrl'].'/themes/default/images/default.jpg'?>" alt="<?=$list['keyword']?>" />
            </a>
        </span>
        <div class="mecc">
            <h3 class="mecctitle"><a href="<?=CommonHelper::getCategoryUrl($list['id'])?>"><?=$list['firstArticle']['title']?></a></h3>
            <address class="meccaddress">
                <time><?=date('m.d', strtotime($list['firstArticle']['add_time']))?></time>
                -
                <span><?=$list['firstArticle']['copyfrom']?></span> - <?=$list['keyword']?>
            </address>
            <p><?=StringHelper::truncate($list['firstArticle']['description'], 130)?></p>
        </div>
        <div class="clear"></div>
    </section>
    <div class="clear"></div>
<?php endforeach;?>
    <!--list-->
<?php echo \yii\widgets\LinkPager::widget([
    'pagination' => $pages,
    'options' => [
        'class' => 'pagenavi'
    ],
    'linkOptions' => [
        'class' => 'page-numbers',
    ]
])?>
