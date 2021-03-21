<h2>
    Démarrez une session
    <br/>
    <span id="showClassroomSelected"></span>
</h2>

<div class="container">

    <?php if($classrooms):?>

        <div class="blog-single segments-page" id="selectClassroomView">
            <div class="container">
                <div class="comment-people">
                    <div class="wrap-title">
                        <h5>
                            Choisissez la classe
                        </h5>
                    </div>

                    <ul id="" class="listView">
                        <?php foreach($classrooms as $classroom):?>
                        <a href="#" class="classrooms" data-classroomid="<?= $classroom->getId();?>" data-classroomname = "<?= $classroom->getName();?>">
                            <li>
                                <?= $classroom->getName();?>
                            </li>
                        </a>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>

        <div id="sessionForm" style="display: none">
            <?php include('_sessionForm.php');?>
        </div>

    <?php else :?>

        <div class="center-align">
            <br/>
            Commencez d'abord par créer une classe ;)
        </div>
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
    <?php endif;?>
</div>
