<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Коментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <? if(!empty($comments)){?>
    <table class="table">
        <thead>
            <tr>
                <td>#</td>
                <td>Автор</td>
                <td>Текст</td>
                <td>Действие</td>
            </tr>
        </thead>
        <tbody>
            <? foreach($comments as $comment): ?>
                <tr>
                    <td><?=$comment->id ?></td>
                    <td><?=$comment->user->name ?></td>
                    <td><?=$comment->text ?></td>
                    <td>
                        <? if($comment->isAllowed()): ?>
                        <a class="btn btn-warning" href="<?= Url::toRoute(['comment/disallow', 'id'=>$comment->id]); ?>">Не позволять</a>
                    <? else: ?>
                        <a class="btn btn-success" href="<?= Url::toRoute(['comment/allow', 'id'=>$comment->id]); ?>">Позволять</a>
                    <? endif;?>
                        <a class="btn btn-danger" href="<?= Url::toRoute(['comment/delete', 'id'=>$comment->id]);?>">Delete</a>
                    </td>

                </tr>
            <? endforeach;?>
        </tbody>
    </table>
    <?}; ?>
</div>
