<h2><?= $title;?> un cycle de formation</h2>

<!-- login -->
<div class="login segments-page">
	<div class="container">
		<div class="wrap-form">
			<form action = "<?= path('updateCycle');?>" method="POST">
				<input type="hidden" name="data[id]" value="<?= $cycle->getId();?>"/>
				<input type="text" placeholder="nom" name="data[name]" value="<?= $cycle->getName();?>">
                <input type="text" placeholder="description" name="data[description]"  value="<?= $cycle->getDescription();?>">
				<input type="date" placeholder="début" name="data[start]"  value="<?= $cycle->getStart();?>">
				<input type="date" placeholder="fin" name="data[end]"  value="<?= $cycle->getEnd();?>">
				<input type="submit" class="red darken-1 white-text" value="<?= $title;?>">
			</form>
		</div>	
	</div>
</div>
<!-- end login -->
