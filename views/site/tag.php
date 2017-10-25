<?
    use yii\helpers\Url;
    use yii\widgets\LinkPager;
    use yii\data\Pagination;
?>
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <? foreach($articles as $article): ?>
                <article class="post post-list">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="post-thumb">
                                <a href="<?=Url::toRoute(['site/view','id'=>$article->article->id]); ?>"><img src="<?=$article->article->getImage();?>" alt="" class="pull-left"></a>

                                <a href="<?=Url::toRoute(['site/view','id'=>$article->article->id]); ?>" class="post-thumb-overlay text-center">
                                    <div class="text-uppercase text-center">View Post</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="post-content">
                                <header class="entry-header text-uppercase">
                                
                                    

                                    <h1 class="entry-title"><a href="<?=Url::toRoute(['site/view', 'id'=>$article->article->id]); ?>"><?=$article->article->title ?></a></h1>
                                </header>
                                <div class="entry-content">
                                    <p><?=$article->article->description;?>
                                    </p>
                                </div>
                                <div class="decoration">
                                   <a href=""><?=$article->tag->title;?></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <? endforeach; ?>

            <? echo LinkPager::widget([
                'pagination' => $pagination,
            ]);?>
            </div>
            <?=$this->render('/partials/sidebar', [
                'popular'=>$popular,
                'recent'=>$recent,
                'categories'=>$categories
                ]); ?>
        </div>
    </div>
</div>
<!-- end main content-->