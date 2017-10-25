                <?php if(!empty($comments)):?>

    <?php foreach($comments as $comment):?>
        <div class="bottom-comment"><!--bottom comment-->
            <div class="comment-img">
                <img width="50" class="img-circle" src="<?= $comment->user->image; ?>" alt="">
            </div>

            <div class="comment-text">
                <a href="#" class="replay btn pull-right"> Replay</a>
                <h5><?= $comment->user->name;?></h5>

                <p class="comment-date">
                    <?= $comment->getDate();?>
                </p>


                <p class="para"><?= $comment->text; ?></p>
            </div>
        </div>
    <?php endforeach;?>

<?php endif;?>
            <? if(!Yii::$app->user->isGuest): ?>
                <div class="leave-comment"><!--leave comment-->
                    <h4>Leave a reply</h4>
                    <? if(Yii::$app->session->getFlash('comment')): ?>
                    <div class="alert alert-success" role="alert">
                        <?=Yii::$app->session->getFlash('comment');?>
                    </div>
                <? endif; ?>
                <? $form = \yii\widgets\ActiveForm::begin([
                    'action'=>['site/comment', 'id'=>$article->id],
                    'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']]) ?>

                    <form class="form-horizontal contact-form" role="form" method="post" action="#">
                        <div >
                        
                        
                            <div class="col-md-12">
                                <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control', 'placeholder'=> 'Write Message'])?>
                            </div>
                        
                        <button type='submit' class="btn send-btn">Post Comment</button>
                        <? \yii\widgets\ActiveForm::end();?>
                    </div>
                    </form>
                </div><!--end leave comment-->
            <? endif; ?>