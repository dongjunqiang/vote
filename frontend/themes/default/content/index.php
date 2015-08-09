<?php
use \Yii;
use \yii\helpers\StringHelper;
use frontend\components\CommonHelper;
?>
<?php foreach ($lists as $list):?>
    <section class="list">
        <h2><?=$list['keyword']?></h2>
        <div class="clear"></div>
        <span class="titleimg">
            <a href="http://www.yzipi.com/2359.htm">
                <img width="270" height="165" src="http://www.yzipi.com/wp-content/uploads/2015/03/SS-270x165.png" class="attachment-thumbnail wp-post-image" alt="SS" />
            </a>
        </span>
        <div class="mecc">
            <h3 class="mecctitle"><a href="<?=CommonHelper::getCategoryUrl($list['id'])?>"><?=$list['firstArticle']['title']?></a></h3>
            <address class="meccaddress">
                <time><?=date('m.d', strtotime($list['firstArticle']['add_time']))?></time>
                -
                <span><?=$list['firstArticle']['copyfrom']?></span>        -
                <?=$list['keyword']?>
            </address>
            <p><?=StringHelper::truncate($list['firstArticle']['description'], 130)?></p>
        </div>
        <div class="clear"></div>
    </section>
    <div class="clear"></div>
<?php endforeach;?>
    <!--list-->
    <div class="pagenavi">
        <span class="page-numbers">1 / 23 </span> <span class='page-numbers current'>1</span> <a class='page-numbers' href='http://www.yzipi.com/page/2' title='第 2 页'>2</a> <a class='page-numbers' href='http://www.yzipi.com/page/3' title='第 3 页'>3</a> <span class="page-numbers">...</span><a class='page-numbers' href='http://www.yzipi.com/page/23' title='最末页'>23</a> <a class='page-numbers' href='http://www.yzipi.com/page/2' title='下一页'>下一页</a>     </div>
    <!--Page End-->
    <nav class="navigation">
        <div class="nav-previous"><a href="http://www.yzipi.com/page/2" >下一页</a></div>

    </nav><!-- .navigation -->
    <!--phonepage-->
