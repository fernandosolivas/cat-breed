
<div class="row col-sm-12 detail">
    <div class="col-sm-5">
        <img class="img-fluid img-detail" src="<?php echo $breed->imageUrl ?>" />
    </div>
    <div class="col-sm-7 flex-column">
        <p class="h3"><?php echo $breed->name ?></p>
        <p><strong>Origin: </strong><?php echo $breed->origin ?></p>
        <p><strong>Temperament: </strong><?php echo $breed->temperament?></p>
        <p><strong>Life span: </strong><?php echo $breed->lifeSpan?> years</p>
        <p class="lead"><?php echo $breed->description ?></p>
        <div class="flex-row" >
            <div class="col-sm-12 col-md-6 detail-link">
                <?php if (property_exists($breed, 'cfa_url')) { ?>
                    <a href="<?php echo $breed->cfa_url ?>" class="btn btn-primary">The Cat Franciers' Association</a>
                <?php } ?>
            </div>
            <div class="col-sm-12 col-md-6 detail-link">
                <?php if (property_exists($breed, 'wikipedia_url')) { ?>
                    <a href="<?php echo $breed->wikipedia_url ?>" class="btn btn-primary">Wikipedia</a>
                <?php } ?>
            </div>
        </div>



    </div>

</div>
