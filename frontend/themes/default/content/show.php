<?php
$this->title = $data['title'] . '_' . Yii::$app->params['title'];
$relateWords = \common\helpers\RelatedWords::getWordsByCache($category['keyword']);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $relateWords ? implode(',', $relateWords) : \Yii::$app->params['keyword']
]);
?>
<nav id="mbx">当前位置：<a href="<?=Yii::$app->params['webUrl']?>">
        首页
    </a> &gt;
    <a href="<?=\frontend\components\CommonHelper::getCategoryUrl($data['keyword_id'])?>" rel="category"><?=$category['keyword']?></a> &gt;  正文</nav>
<!--mbx-->
<article class="content">
    <header class="contenttitle">
        <div class="mscc">
            <h1 class="mscctitle">
                <a href="<?=\frontend\components\CommonHelper::getArticleUrl($data['keyword_id'], $data['id'])?>"><?=$data['title']?></a>
            </h1>
            <address class="msccaddress ">
                <em>已有 <span id="hits"></span> 人阅读此文 -</em>
                <time><?=date('Y-m-d',strtotime($data['add_time']))?></time>
                -
                <a href="<?=\frontend\components\CommonHelper::getCategoryUrl($data['keyword_id'])?>" rel="category"><?=$category['keyword']?></a>
            </address>
            <div class="bshare-custom"></div>
        </div>
    </header>
    <div class="content-text">
        <?=$data['content']['content']?>
    </div>
    <!--content_text-->
    <footer class="article-tag">
    <?php
    $comma = '';
    foreach ($relateWords as $word) {
        echo $comma,$word;
        $comma = ' , ';
    }
    ?>
    </footer>
    <!--article-tag-->
</article>
<!--content-->
<nav class="nav-single">
<?php if ($this->beginCache('show_around_'.$data['id'], ['duration' => 600])):?>
    <?php $prevArticle = \common\api\cms\ArticleApi::getPrevArticle($data['id']);?>
    <span class="nav-previous">
    <?php if (is_array($prevArticle)):?>
        &larr; <a href="<?=\frontend\components\CommonHelper::getArticleUrl($prevArticle['keyword_id'], $prevArticle['id'])?>" rel="next"><?=$prevArticle['title']?></a>
    <?php else:?>
        <?=$prevArticle?>
    <?php endif;?>
    </span>
    <?php $nextArticle = \common\api\cms\ArticleApi::getNextArticle($data['id']);?>
    <span class="nav-next">
    <?php if (is_array($nextArticle)):?>
        <a href="<?=\frontend\components\CommonHelper::getArticleUrl($nextArticle['keyword_id'], $nextArticle['id'])?>" rel="prev"><?=$nextArticle['title']?></a> &rarr;
    <?php else:?>
        <?=$nextArticle?>
    <?php endif;?>
    </span>
<?php
    $this->endCache();
endif;
?>
</nav>

<!--相关文章-->
<div class="xianguan">
    <div class="xianguantitle">相关文章</div>
<?php if ($this->beginCache('show_relate_'.$data['id'], ['duration' => 3600])):?>
    <?php $articles = \common\api\cms\ArticleApi::getRelatedArticles($data['keyword_id'], 4);?>
    <ul class="pic">
    <?php foreach ($articles as $r):?>
        <?php $url = \frontend\components\CommonHelper::getArticleUrl($r['keyword_id'], $r['id'])?>
    <li>
        <a href="<?=$url?>"><img width="400" height="244" src="<?=$r['thumb']?>" alt="<?=\yii\helpers\Html::encode($r['title'])?>" /></a>
        <a rel="bookmark" href="<?=$url?>" title="<?=\yii\helpers\Html::encode($r['title'])?>" class="link"><?=$r['title']?></a>
    </li>
    <?php endforeach;?>
    </ul>
<?php
    $this->endCache();
endif;
?>
</div>
<!--相关文章-->

<!--高速版-->
<!--<div id="SOHUCS"></div>-->
<!--<script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>-->
<!--<script type="text/javascript">-->
<!--    window.changyan.api.config({-->
<!--        appid: 'cyrUsAQkY',-->
<!--        conf: 'prod_3274dad3c464912ca6b376ec36383c72'-->
<!--    });-->
<!--</script>-->

<?php
Yii::$app->view->registerJs('
$.getJSON("'.\yii\helpers\Url::to(['api/count', 'keywordId'=>$data['keyword_id'], 'articleId' => $data['id']]).'", function(item){
    var views = item.list.views != undefined ? parseInt(Math.round(new Date().getTime()/1000) / 1000000) + item.list.views : parseInt(Math.round(new Date().getTime()/1000) / 1000000);
    $("#hits").text(views);
});');
?>