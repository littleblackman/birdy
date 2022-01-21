<h2>
    <?=  $session->getName();?>
    <br/>
    <span id="showClassroomSelected">
        <?= $session->getClassroom()->getName();?>
    </span>
</h2>

<div class="container">     
        <input type="hidden" name="id" value="<?= $session->getId();?>" id="currentSessionId"/>

        <div id="showSessionInformation">
            <?php include('_sessionInformation.php');?>
        </div>

        <?php $classroom = $session->getClassroom();?>
        <div id="showStudentListView">
            <ul class="collapsible">
                <?php include(VIEW.'classroom/_studentList.php');?>
            </ul>
        </div>
</div>

 <!-- features -->

    <div class="features segments">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <?php if($session->getStep() == "create"):?>
                        <a href="<?= path('deleteSession', $session->getId());?>">
                            <div class="content">
                                <i class="fas fa-trash bg-red"></i>
                                <h5>Supprimer</h5>
                            </div>
                        </a>
                        <?php elseif ( $session->getStep() == "close" ):?>
                            <a href="<?= path('openSessionAgain', $session->getId());?>">
                            <div class="content">
                                <i class="fas fa-trash bg-blue"></i>
                                <h5>Ouvrir</h5>
                            </div>
                        </a>

                        <?php endif;?>
                    </div>	
                </div>
                
            </div>
    </div>
