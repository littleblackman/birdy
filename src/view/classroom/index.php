<h2>Gestion des classes</h2>


<?php if($classrooms):?>

<div class="blog-single segments-page">
    <div class="container">
        <div class="comment-people">
            <div class="wrap-title">
                <h5>Classes Actives</h5>
            </div>

            <ul id="" class="listView">
                <?php foreach($classrooms as $classroom):?>
                <a href="<?= path('showClassroom', $classroom->getId());?>">
                    <li>
                        <?= $classroom->getName();?>
                    </li>
                </a>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>

<?php else :?>

    <div class="center-align">
        <br/>
        Il est temps de démarrer le boulot...
    </div>
<?php endif;?>

<div class="services segments-page">
		<div class="container">
            <a href="<?= path('editClassroom');?>">
                <div class="content bg-blue">
                    <div class="services-caption">
                        <h4>Créer une classe</h4>
                    </div>
                </div>
            </a>
        </div>
</div>