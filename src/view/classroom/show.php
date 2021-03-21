
<h2>
    <span class="info">#</span><span id="classroomid" class="info"><?= $classroom->getId();?></span>
    Classe - 
    <?= $classroom->getName();?>
</h2>

<div class="blog-single segments-page">
    <div class="container">

        <p>
            <?= $classroom->getDescription();?>
        </p>
        <hr/>

        <div class="comment-people">
            <ul class="collapsible">
                <?php include('_studentList.php');?>
                <?php include('_studentPresence.php');?>
            </ul>
            <br/>
            <hr/>
            <br/>
            <h6>Ajouter un apprenant</h6>
            <br/>
            <form action = "<?= path('createUser');?>" method = "POST" id="addUserForm">
                <input type="text" placeholder="Prénom" name="firstname">
                <input type="text" placeholder="Nom" name="lastname">
                <input type="Email" placeholder="Email" name="email">
                <input type="hidden" name="classroomId" value="<?= $classroom->getId();?>">
                <input type="submit" class="red darken-1 white-text fullwdith" value="Ajouter" id="addUserButton"/>
            </form>
        </div>
    </div>
</div>

 <!-- features -->
 <div class="features segments">
		<div class="container">
			<div class="row">
				<div class="col s6">
					<a href="<?= path('editClassroom', $classroom->getId());?>">
						<div class="content">
                            <i class="fas fa-edit bg-blue"></i>
							<h5>Modifier</h5>
						</div>
					</a>
				</div>
				<div class="col s6">
					<a href="<?= path('deleteClassroom', $classroom->getId());?>">
						<div class="content">
                            <i class="fas fa-trash bg-red"></i>
							<h5>Supprimer</h5>
						</div>
					</a>
				</div>	
			</div>
			
		</div>
</div>



