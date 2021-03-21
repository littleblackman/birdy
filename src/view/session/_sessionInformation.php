<?php use_helper('translation, text');?>
<input type="hidden" name="id" id="currentSessionIdForm"/>
<div class="text" style="margin: 20px">
    <h4 class="center-align" id="currentSessionName"></h4>
    <br/>
    <div class="row">
        <div class="col s6">
            <div class="content-text">
                Date :  
                <span id="currentSessionDate">
                    <?= $session->getDateDate()->format('d/m/Y');?>
                </span>
            </div>
        </div>
        <div class="col s6">
            <div class="content-text">
                Statut:
                <span id="currentSessionStep"><?= $session->getStep()?></span>
                <?= showIcon($session->getStep());?>
                <span id="showCommand" style='display: <?= ($session->getStep()=="open") ? "inline-block" : "none";?>'>
                    &nbsp;&nbsp;
                    <a href="<?= path('closeSession', $session->getId());?>">
                        <button class="button red" id="closeSession">Clôturer la session</button>
                    </a>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s6">
            <div class="content-text">
                Début : 
                <span id="currentSessionStart">
                    <?= $session->getStartDate()->format('H:i');?>
                </span>
            </div>
        </div>
        <div class="col s6">
            <div class="content-text">
                Fin : 
                <span id="currentSessionEnd">
                    <?= $session->getEndDate()->format('H:i');?>
                </span>
            </div>
        </div>
    </div>

    <div>
        <h4>Contenu de la session</h4>

        <?php if($session->getStep() != "close"):?>
            <textarea id="currentSessionAgenda" name="currentSessionAgenda">
                <?= $session->getAgenda();?>
            </textarea>
            <button class="button red" id="saveCurrentSessionAgenda">Enregistrez le contenu</button>
        <?php else:?>
            <?= $session->getAgenda();?>
        <?php endif;?>
    </div>
    <br/><br/><br/>
    <div>
        <h4>Objectifs d'apprentissage</h4>
     
        <div id="modalSkill" class="modal">
            <div class="modal-content">

                <h6>Sélectionnez les critères d'évaluation</h6>
                <br/>
                <ul class="listViewCompact">
                    <?php foreach($criteriass as $criterias):?>
                        <li data-criteriaid="<?= $criterias->getId();?>" class="selectCriteria unactive">
                            <b><?= $criterias->getName();?></b> : <i><?= implode(', ', $criterias->getValues())?></i>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
            <div class="modal-footer">
                <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Annuler</a>
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat" id="validCriteria">Valider</a>
            </div>
        </div>

        <ul id="currentSessionSkill" class="collection">
            <?php if($session->getSkills()):?>
                <?php foreach($session->getSkills() as $skill):?>
                    <li class="collection-item" id="itemSkill<?= $skill->getId() ;?>">
                        <a class="modal-trigger skillSelected" data-skillid="<?= $skill->getId();?>" href="#modalSkill"><?= $skill->getName();?></a>
                        <?php if($session->getStep() != "close"):?>
                            <a href="#" class="secondary-content" onclick="deleteClick(<?= $skill->getId();?>)">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        <?php endif;?>
                        <?php ($skill->getCriteriasId()) ? $style = "inline-block" : $style = "none";?>
                        <i class="fas fa-check" style="display: <?= $style;?>; color: darkgreen" id="checkIconSkill<?=$skill->getId();?>"></i>
                    </li>
                <?php endforeach;?>
            <?php else:?>
                <br/><i>Aucun objectif défini</i>
            <?php endif;?>
        </ul>
        <br/>
        <?php ($session->getStep() != "close") ? $style="block" : $style="none" ?>
        <input type="text" name="skill" placeholder="Ajouter un objectif d'apprentissage" id="inputSkill" style="display:<?= $style;?>"/>
    </div>
    <br/>
</div>