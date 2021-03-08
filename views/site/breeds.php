<?php
    use yii\helpers\Url;
?>
<div class="row col-sm-12 card-list">
    <?php foreach ($breeds as $breed): ?>
        <div class="col-sm-12  col-md-5 col-lg-5 card">
            <?php if (property_exists($breed, 'image') && property_exists($breed->image, 'url')) { ?>
                <img class="img-fluid card-img-top" src="<?php echo $breed->image->url ?>" alt="Card image cap">
            <?php } else { ?>
                <img alt="cat image" class="img-fluid card-img=top" src="https://user-images.githubusercontent.com/194400/49531010-48dad180-f8b1-11e8-8d89-1e61320e1d82.png" />
            <?php } ?>
            <div class="card-body card-content">
                <h5 class="card-title"><?= \yii\helpers\Html::encode("{$breed->name}") ?></h5>
                <a href="<?php echo Url::to(['site/breed-detail', 'id' => $breed->id])?>" class="btn btn-primary">About</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

