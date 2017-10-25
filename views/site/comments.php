<?
use yii\widgets\LinkPager;
?>
<h1>КОмментарии</h1>
<h2>Last seen profile <a href="<?=Yii::$app->urlManager->createUrl(['site/user','name'=>$comment->name])?>">:<?=$name ?></a><?=$comment->text?></h2>
<ul>
<? foreach ($comments as $comment) { ?>
	<li><b><a href="<?=Yii::$app->urlManager->createUrl(['site/user','name'=>$comment->name])?>"><?=$comment->name ?></a><?=$comment->text?></b><?=$comment->text ?></li>
<? } ?>
</ul>
<?= LinkPager::widget(['pagination' => $pagination]) ?>