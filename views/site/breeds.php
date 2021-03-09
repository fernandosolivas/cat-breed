<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>
<div class="row col-sm-12 card-list">
    <div class="col-sm-12 flex-row">
        <?php
        $form = ActiveForm::begin([
            'id' => 'search-form',
            'options' => ['class' => 'flex-row col-sm-12'],
        ]) ?>

        <?= $form->field($model, 'name') ?>
        <div class="form-group">
            <div class="search-container col-lg-offset-4 col-lg-3">
                <?= Html::submitButton('Search', ['class' => 'col-md-12 col-sm-6 btn btn-secondary']) ?>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>

    <?php if(count($breeds) === 0) { ?>
        <div class="col-sm-12">
            <h2>No breed with name <?php echo $model->name ?> was found</h2>
        </div>
    <?php } ?>

    <?php foreach ($breeds as $breed): ?>
        <div class="col-sm-12  col-md-5 col-lg-5 card">
            <img class="img-fluid card-img-top" src="<?php echo $breed->imageUrl ?>" alt="Card image cap">
            <div class="card-body card-content">
                <h5 class="card-title"><?= \yii\helpers\Html::encode("{$breed->name}") ?></h5>
                <a href="<?php echo Url::to(['site/breed-detail', 'id' => $breed->id])?>" class="btn btn-primary">About</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

