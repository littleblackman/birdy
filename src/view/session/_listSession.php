<?php use_helper('text');?>
<ul id="" class="listView">
    <?php foreach($sessions as $session):?>
    <a href="<?= path('showSession', $session->getId());?>">
        <li class="doubleLine">
            <div class="easyFlex">
                <div>
                    <i class="fas fa-graduation-cap darkBlueText"></i>
                    <?= $session->getClassroomName()?>
                </div>
                <div><?= showIcon($session->getStep());?></div>
            </div>
            <div class="info">
                <?= $session->getName().'<br/>'.$session->getDateDate()->format('d/m/y').' '.$session->getStartDate()->format('H:i');?>
            </div>
            <?php if(strlen($session->getAgenda()) > 5):?>
                <div class="info shortView">
                    <?= $session->getAgenda();?>
                </div>
            <?php endif;?>
            <?php if($session->getNbSkills() > 0):?>
                <div class="info shortView">
                    <p><?= $session->getNbSkills();?> compétences</p>
                </div>
                <?php endif;?>

        </li>
    </a>
    <?php endforeach;?>
</ul>