<?php
$this->title = '热门新闻_'.Yii::$app->params['title'];
?>
<article class="content">
    <header class="hottitle">随机推荐</header>
    <?php foreach ($data as $row):?>
    <section class="hot-list">
        <div class="hotmecc">
            <span class="mulu"><a href="<?=\frontend\components\CommonHelper::getCategoryUrl($row['keyword_id'])?>" target="_blank"><?=$row['keyword']?></a></span>
            <h2 class="mecctitle"><a href="<?=\frontend\components\CommonHelper::getArticleUrl($row['keyword_id'], $row['id'])?>"><?=$row['title']?></a></h2>
            <address class="meccaddress">
                <time><?=date('Y.m.d', strtotime($row['add_time']))?></time>
            </address>
            <p><?=\yii\helpers\StringHelper::truncate($row['description'], 150)?></p>
        </div>
        <div class="clear"></div>
    </section>
    <?php endforeach;?>
</article>
