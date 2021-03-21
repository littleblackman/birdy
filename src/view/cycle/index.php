<h2>Gestion des cycles de formations</h2>

<div class="blog-single segments-page">
    <div class="container">
        <div class="comment-people">
            <div class="wrap-title">
                <h5>Cycles Actifs</h5>
            </div>
            <?php foreach($cycles as $cycle):?>
                <div class="content">
                    <div class="text">
                        <h6>
                            <?= $cycle->getName();?>
                        </h6>
                        <div class="commands">
                            <a href="<?= path('editCycle', $cycle->getId());?>"><i class="fas fa-edit"></i></a>
                            <i class="fas fa-eye"></i>
                            <a href="<?= path('deleteCycle', $cycle->getId());?>"><i class="fas fa-trash"></i></a>
                        </div>
                        <p class="date">
                            <?= $cycle->getStartDate()->format('d/m/Y');?>
                            -
                            <?= $cycle->getEndDate()->format('d/m/Y');?>
                        </p>
                        <p><?= $cycle->getDescription();?></p>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>

<div class="services segments-page">
		<div class="container">
            <a href="<?= path('editCycle');?>">
                <div class="content bg-blue">
                    <div class="services-caption">
                        <h4>Créer un cycle</h4>
                    </div>
                </div>
            </a>
        </div>
</div>