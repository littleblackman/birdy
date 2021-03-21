<?php use_helper('form');?>
<h2><?= $title;?> une classe</h2>

<!-- login -->
<div class="login segments-page">
	<div class="container">
		<div class="wrap-form">
			<form action = "<?= path('updateClassroom');?>" method="POST">
				<input type="hidden" name="data[id]" value="<?= $classroom->getId();?>"/>
				<input type="text" placeholder="nom" name="data[name]" value="<?= $classroom->getName();?>">
                <input type="text" placeholder="description" name="data[description]" value="<?= $classroom->getDescription();?>">


				<div class="checkboxes">
					<?php $idList = $classroom->getCyclesIdList();?>
					<?php foreach($cycles as $cycle):?>
						<div>	
							<input  id="cycle<?= $cycle->getId();?>"
									type="checkbox" name ="data[cyclesIdList][<?= $cycle->getId();?>]"
									value = "<?= $cycle->getId();?>" 
									<?php if(in_array($cycle->getId(), $idList)) echo 'checked';?>
									>
							<label for="cycle<?= $cycle->getId();?>"><span><?= $cycle->getName();?></span></label>
						</div>
					<?php endforeach;?>	
				</div>		
				<br/>	
				<input type="submit" class="red darken-1 white-text fullwdith" value="<?= $title;?>">
			</form>
		</div>	
	</div>
</div>
<!-- end login -->
