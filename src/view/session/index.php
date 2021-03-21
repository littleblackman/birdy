<?php use_helper('form, text');?>
<h2>Gestion des sessions</h2>

    <div class="blog-single segments-page">
        <div class="container">
            <div class="comment-people">
                <div class="wrap-title">
                    <h3 class="center-align">Sessions Passées</h3>
                </div>

                <div class="easyFlex">
                    <div>
                        <label for="classroomSelect">Cycle</label>
                        <select name="cycle_id" id="cycleSelect" class="selecCriteria" data-url = "<?= path('session');?>">>
                            <?php foreach($cycles as $cycle):?>
                                <option value="<?= $cycle->getId();?>" <?= selected($cycleId, $cycle->getId());?>><?= $cycle->getName();?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div>
                        <label for="stepSelect">Statut</label>
                        <select name="step" id="stepSelect" class="selecCriteria" data-url = "<?= path('session');?>">
                            <option value="all" <?= selected($stepSession, 'all');?>>Toutes</option>
                            <option value="create" <?= selected($stepSession, 'create');?>>Create</option>
                            <option value="open" <?= selected($stepSession, 'open');?>>Open</option>
                            <option value="close" <?= selected($stepSession, 'close');?>>Close</option>
                        </select>
                    </div>

                    <div>
                        <label for="classroomSelect">Classes</label>
                        <select name="classroom_id" id="classroomSelect" class="selecCriteria" data-url = "<?= path('session');?>">>
                            <option value="all">Toutes</option>
                            <?php foreach($classrooms as $classroom):?>
                                <option value="<?= $classroom->getId();?>" <?= selected($classroomId, $classroom->getId());?>><?= $classroom->getName();?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <br/>

                <?php if($sessions):?>
                <div id="showListView">
                    <?php include('_listSession.php');?>
                </div>
                <?php else :?>
                    Aucune session trouvé !
                <?php endif;?>
            </div>
        </div>
    </div>

    <div class="center">
        <?php if($page > 1 ):?>
            <a href="<?= path('session', $page.'/'.$classroomId.'/'.$stepSession.'/'.$cycleId.'/prev');?>" style="text-align: center">
                <i class="fas fa-chevron-left"></i>
            </a>
        <?php endif;?>
        &nbsp;&nbsp;
        <button id="currentPage" data-page="<?= $page;?>">
            <?= $page;?>
        </button>
        &nbsp;&nbsp;
        <?php if($page < $maxPage):?>
            <a href="<?= path('session', $page.'/'.$classroomId.'/'.$stepSession.'/'.$cycleId.'/next');?>" style="text-align: center">
                <i class="fas fa-chevron-right"></i>
            </a>
        <?php endif;?>
    </div>



<div class="services segments-page">
		<div class="container">
            <a href="<?= path('startSession');?>">
                <div class="content bg-blue">
                    <div class="services-caption">
                        <h4>Démarrer une session</h4>
                    </div>
                </div>
            </a>
        </div>
</div>