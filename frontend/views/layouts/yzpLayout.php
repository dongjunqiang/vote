<?php
use yii\helpers\Html;
use frontend\assets\XzpAsset;
use frontend\components\CommonHelper;

/* @var $this \yii\web\View */
/* @var $content string */

XzpAsset::register($this);
$webUrl = Yii::$app->params['webUrl'];
$baseUrl = \Yii::$app->request->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title><?=isset($this->title) ? $this->title : Yii::$app->params['title']?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header id="header-web">
    <div class="header-main">
        <hgroup class="logo">
            <div><a href="<?=$webUrl?>" title="<?=Yii::$app->params['title']?>" rel="home"><img src="<?=$baseUrl?>/themes/default/images/logo.png" alt="<?=Yii::$app->params['title']?>"></a></div>
            <h3>最新的新闻事件，新闻热点！</h3>
        </hgroup>
        <!--logo-->
        <nav class="header-nav">
            <ul id="menu-nav" class="menu">
                <li><a href="<?=Yii::$app->params['webUrl']?>">首页</a></li>
                <li><a title="热门随机文章" href="<?=\yii\helpers\Url::to(['content/random'])?>">热文</a></li>
            </ul>
        </nav>
        <!--header-nav-->
        <!--header-main-->
    </div>
</header>
<!--header-web-->
<div id="main">
    <div id="soutab">
        <?php $form = \yii\widgets\ActiveForm::begin(['action' => \yii\helpers\Url::to(['content/search']), 'method' => 'post', 'options' => ['class' => 'search', 'target' => '_blank']]); ?>
            <input class="text" type="text" name="s" placeholder="搜索一下">
            <input class="button" value="搜索" type="submit">
        </form>
    </div>
    <div id="container">
        <?= $content ?>
    </div>
    <!--Container-->
    <aside id="sitebar">
        <div class="sitebar_list">
            <div class="wptag">
                <span class="tagtitle">热门关键词+</span>
                <div class="tagg">
                    <ul id="menu-keywords" class="menu">
                    <?php if ($this->beginCache('hot_keywords_cache', ['duration' => 1800])):?>
                        <?php foreach (\common\api\cms\KeywordApi::getHotKeywords(20) as $r):?>
                        <li><a href="<?=CommonHelper::getCategoryUrl($r['keywordInfo']['id'])?>"><?=$r['keywordInfo']['keyword']?></a></li>
                    <?php
                        endforeach;
                        $this->endCache();
                        endif;
                    ?>
                    </ul>
                </div>
            </div>
        </div>
        <!--author-->
        <div class="sitebar_list">
            <h4 class="sitebar_title">精评文章</h4>
            <ul class="sitebar_list_ul">
                <?php if ($this->beginCache('hot_articles_cache', ['duration' => 3600])):?>
                <?php foreach (\common\api\cms\ArticleApi::getHotArticle(20) as $r):?>
                <li><a href="<?=CommonHelper::getArticleUrl($r['kid'], $r['aid'])?>" title="<?=Html::encode($r['articleInfo']['title'])?>"> <?=\yii\helpers\StringHelper::truncate($r['articleInfo']['title'], 23,'')?></a></li>
                <?php
                    endforeach;
                    $this->endCache();
                endif;
                ?>
            </ul>
        </div>
        <!--random-->
    </aside>
    <div class="clear"></div>
</div>
<footer id="dibu">
    <div class="about">
        <div class="right">
            <ul id="menu-bottom-nav" class="menu">
                <li class="menu-item menu-item-type-post_type menu-item-object-page">桔子新闻：<?=Yii::$app->params['webUrl']?></li>
            </ul>
            <p class="banquan">
                桔子新闻，收集互联网上的新闻热点，新闻资讯！
            </p>
        </div>
        <div class="left">
            <ul class="bottomlist">
                <li>
                    <img src="<?=$baseUrl?>/themes/default/images/weibo.png" alt="桔子新闻新浪微博">
                </li>
                <li>
                    <img src="<?=$baseUrl?>/themes/default/images/weixin.png" alt="桔子新闻微信公众号">
                </li>
            </ul>
        </div>
    </div>
    <!--about-->
</footer>
<?php $this->endBody() ?>
<!-- 百度统计 -->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?6ce933ac28fb618befb539105093f65c";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</body>
</html>
<?php $this->endPage() ?>
