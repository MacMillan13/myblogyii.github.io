<?
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
?>
<?
if($name){ ?>
<p>Вы ввели имя <b><?=$name ?></b> и email <b><?=$email; ?></b></p>
<? }; ?>
<? $f = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
	<?=$f->field($form, 'name'); ?>
	<?=$f->field($form, 'email'); ?>
	<?=$f->field($form, 'file')->fileInput(); ?>
	<?= Html::submitButton('Отправить'); ?>
<? ActiveForm::end(); ?>