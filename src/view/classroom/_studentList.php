<?php (isset($session)) ? $presencesData = $session->getPresencesData() : $presencesData = [];?> 

<li>
    <div class="collapsible-header">
        <h5>
            <i class="fas fa-user-graduate"></i>
            Liste des apprenants (<?= $classroom->getNbStudents();?>)
        </h5>
    </div>
    
    <div class="collapsible-body">
            <ul id="studentsList" class="listView">
                <?php foreach($classroom->getStudents() as $student):?>

                <li class="showItemDetailButton <?php if(is_array($presencesData) && key_exists($student->getId(), $presencesData)) echo $presencesData[$student->getId()];?>" 
                    data-studentid="<?= $student->getId();?>" 
                    id="student-row-<?= $student->getId() ;?>">

                    <?php if($student->getAvatarFilename()):?>
                        <img src="<?= ASSETS.$student->getAvatarCropped();?>" alt="">
                    <?php else :?>
                        <div class="initialStudent"><?= $student->getInitials();?></div>
                    <?php endif;?>
                    <?= $student->getFullnameReverse(true);?>
                </li>
                <?php endforeach;?>
            </ul>

    </div>
</li>
