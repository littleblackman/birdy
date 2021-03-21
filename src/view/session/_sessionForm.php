<?php use_helper('form');?>


<!-- login -->
<div class="login segments-page">
	<div class="container">
        <a href="<?= path('startSession');?>">
            <i class="fas fa-sync-alt left"></i>
            Recommencez
        </a>
		<div class="wrap-form">
			<form action = "<?= path('updateSession');?>" method="POST" id="createSessionForm">
				<input type="hidden" name="classroom_id" id="classrommInputId"/>
				<input type="text" placeholder="nom" name="name" value="Session du <?= date('d/m/Y');?>"/>
                <input type="text" placeholder="description" name="description"/>

                <input type="date" placeholder="date" name="date"  value="<?= date('Y-m-d');?>">
                <input type="time" placeholder="début" name="start"  value="<?= date('H:i');?>">
                <input type="time" placeholder="fin" name="end" value="<?= date("H:i", strtotime ("+1 hour"));?>">

                <select name="cycle_id">
                    <?php foreach($cycles as $cycle):?>
                        <option value="<?= $cycle->getId();?>"><?= $cycle->getName();?></option>
                    <?php endforeach;?>
                </select>
				<input type="submit" class="red darken-1 white-text fullwdith" value="Valider" id="submitButton">
			</form>
		</div>	
	</div>
</div>
<!-- end login -->
