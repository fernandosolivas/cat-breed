
<div class="row col-sm-12 detail">
    <div class="col-sm-5">
        <img class="img-fluid img-detail" src="<?php echo $imageUrl ?>" />
    </div>
    <div class="col-sm-7 flex-column">
        <p class="h3"><?php echo $breed->name ?></p>
        <p><strong>Origin: </strong><?php echo $breed->origin ?></p>
        <p><strong>Temperament: </strong><?php echo $breed->temperament?></p>
        <p><strong>Life span: </strong><?php echo $breed->life_span?> years</p>
        <p class="lead"><?php echo $breed->description ?></p>
        <a href="<?php echo $breed->cfa_url ?>" class="btn btn-primary">More</a>
    </div>

</div>
