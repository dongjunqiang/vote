<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\XzpAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

XzpAsset::register($this);
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
            <h1><a href="<?=Yii::$app->params['webUrl']?>" title="<?=Yii::$app->params['title']?>" rel="home"><img src="http://www.yzipi.com/wp-content/themes/yzipi/images/logo.png" alt="<?=Yii::$app->params['title']?>"></a></h1>
            <h3>互联网的运营笔记！</h3>
        </hgroup>
        <!--logo-->
        <nav class="header-nav">
            <ul id="menu-nav" class="menu"><li id="menu-item-4" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-4"><a href="<?=Yii::$app->params['webUrl']?>">首页</a></li>
                <li id="menu-item-31" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-31"><a title="运营观点与思想" href="http://www.yzipi.com/category/view">观点</a></li>
                <li id="menu-item-668" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-668"><a title="营销思想" href="http://www.yzipi.com/category/marketing">营销</a></li>
                <li id="menu-item-2013" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2013"><a href="http://www.yzipi.com/recommend">推荐</a></li>
                <li id="menu-item-1958" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1958"><a title="热门随机文章" href="http://www.yzipi.com/hotrandom">热文</a></li>
            </ul>    </nav>
        <!--header-nav-->
        <!--header-main-->
    </div>
</header>
<!--header-web-->
<div id="main">
    <div id="soutab">
        <form method="get" class="search" action="<?=Yii::$app->params['title']?>" >
            <input class="text" type="text" name="s" placeholder="搜索一下">
            <input class="button" value="搜索" type="submit">
        </form>
    </div>
    <div id="container">
        <?= $content ?>
    </div>
    <!--Container-->
    <aside id="sitebar">
        <div class="erweima"><a href="#0" class="cd-popup-trigger"><img src="http://www.yzipi.com/wp-content/themes/yzipi/images/erweima.png" ></a></div>
        <!--erweima-->
        <div class="sitebar_list"><div class="wptag"> <span class="tagtitle">热门关键词+</span>
                <div class="tagg">
                    <ul id="menu-keywords" class="menu">
                    <?php if ($this->beginCache('hot_keywords', ['duration' => 3600])):?>
                        <?php foreach (\common\api\cms\KeywordApi::getHotKeywords() as $r):?>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="<?=\yii\helpers\Url::to(['content/show','id'=>$r['keywordInfo']['id']])?>"><?=$r['keywordInfo']['keyword']?></a></li>
                        <?php
                        endforeach;
                        $this->endCache();
                        endif;
                    ?>
                    </ul>
                </div>
                <span class="tagtitle">特色词组+</span>
                <div class="tagg">
                    <ul id="menu-tag" class="menu"><li id="menu-item-1504" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1504"><a href="http://www.yzipi.com/category/duanzi">柚段子</a></li>
                        <li id="menu-item-1323" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1323"><a href="http://www.yzipi.com/category/marketing/psychology">营销心理学</a></li>
                        <li id="menu-item-2065" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2065"><a href="http://www.yzipi.com/category/view/entrepreneurship">创业</a></li>
                        <li id="menu-item-2064" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2064"><a href="http://www.yzipi.com/category/marketing/marketing-idea">营销思想</a></li>
                        <li id="menu-item-2070" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2070"><a href="http://www.yzipi.com/category/view/user-study">用户研究</a></li>
                        <li id="menu-item-2066" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2066"><a href="http://www.yzipi.com/category/view/team">团队</a></li>
                        <li id="menu-item-2068" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2068"><a href="http://www.yzipi.com/category/view/dianshan">电子商务</a></li>
                        <li id="menu-item-2069" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2069"><a href="http://www.yzipi.com/category/view/product">产品分析</a></li>
                        <li id="menu-item-2071" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2071"><a href="http://www.yzipi.com/category/view/manage">管理</a></li>
                        <li id="menu-item-2342" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2342"><a href="http://www.yzipi.com/yzipiwp">wordpress原创主题</a></li>
                    </ul>    </div>
            </div>
        </div>
        <!--author-->
        <div class="sitebar_list">
            <h4 class="sitebar_title">精评文章</h4>
            <ul class="sitebar_list_ul">
                <li><a href="http://www.yzipi.com/326.htm" title="识别好公司还是烂公司的三张图"> 识别好公司还是烂公司的三张图</a></li>
                <li><a href="http://www.yzipi.com/1505.htm" title="从泡妞段子看你的资金运作水平"> 从泡妞段子看你的资金运作水平</a></li>
                <li><a href="http://www.yzipi.com/1613.htm" title="牛逼的标题如何起?不能说的秘密(10条)"> 牛逼的标题如何起?不能说的秘密(10条)</a></li>
                <li><a href="http://www.yzipi.com/1257.htm" title="嗅觉营销：人的情绪有75％是由嗅觉产生"> 嗅觉营销：人的情绪有75％是由嗅觉产生</a></li>
                <li><a href="http://www.yzipi.com/1778.htm" title="牛逼的产品运营能做到这样，你行不，同学？"> 牛逼的产品运营能做到这样，你行不，同学？</a></li>
                <li><a href="http://www.yzipi.com/2014.htm" title="【腾讯美女】陈婷婷：七情六欲聊运营"> 【腾讯美女】陈婷婷：七情六欲聊运营</a></li>
            </ul>
        </div>
        <!--random-->
    </aside>
    <div class="clear"></div>
</div>
<footer id="dibu">
    <div class="about">
        <div class="right">
            <ul id="menu-bottom-nav" class="menu"><li id="menu-item-69" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69"><a href="http://www.yzipi.com/about">关于我们</a></li>
                <li id="menu-item-1758" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1758"><a href="http://www.yzipi.com/juanz">打赏柚皮</a></li>
                <li id="menu-item-68" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-68"><a href="http://www.yzipi.com/activity">网站标签</a></li>
                <li id="menu-item-1953" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1953"><a href="http://www.yzipi.com/link">友情连接</a></li>
                <li id="menu-item-1973" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1973"><a href="http://www.yzipi.com/contribute">好文投稿</a></li>
            </ul>      <p class="banquan">
                柚子皮        ，
                互联网的运营笔记！      </p>
        </div>
        <div class="left">
            <ul class="bottomlist">
                <li>
                    <a href="http://weibo.com/234836886" target="_blank"　title=""><img src="http://www.yzipi.com/wp-content/themes/yzipi/images/weibo.png" alt="柚子皮新浪微博"></a>
                </li>
                <li>
                    <a href="#0" class="cd-popup-trigger"><img src="http://www.yzipi.com/wp-content/themes/yzipi/images/weixin.png" alt="柚子皮微信公众号"></a>
                </li>
            </ul>
            <div class="cd-popup" >
                <div class="cd-popup-container">
                    <h1>扫描二维码，加柚子皮微信公众号</h1>
                    <img src="http://www.yzipi.com/wp-content/themes/yzipi/images/yzipi6.png">
                    <a href="#" class="cd-popup-close"></a>
                </div> <!-- cd-popup-container -->
            </div> <!-- cd-popup -->

        </div>
    </div>
    <!--about-->
    <div class="bottom">
        <a href="http://www.yzipi.com">柚子皮</a>
        <a href="http://www.yzipi.com/yzipi4" target="_blank"><font color="#d6623d">Yzipi5.31</font></a> <a href="http://www.miitbeian.gov.cn/">粤ICP备13063893号-6</a><div class="tongji"></div>
    </div>
    <!--bottom-->
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
