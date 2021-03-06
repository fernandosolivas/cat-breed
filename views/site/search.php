<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'breed')->label('Raça') ?>
<div class='form-group'>
    <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
</div>

<?php if($model->breed !== null) {?>
    <div> olá <?php echo $model->breed ?> </div>
<?php } ?>
<?php ActiveForm::end(); ?>