<!-- teacher single -->
    <div class="teacher-single segments-page">
		<div class="container">
			<div class="commands">
				<i class="fas fa-chevron-left" onclick="showPrevStudent(<?= $student->getId();?>)"></i>
				<i class="fas fa-chevron-right" onclick="showNextStudent(<?= $student->getId();?>)"></i>
			</div>
			<div class="content">
				<?php if($student->getAvatarFilename()):?>
					<img src="<?= ASSETS.$student->getAvatar();?>" alt="avatar <?= $student->getFullname();?>">
				<?php else :?>
					<div class="initialStudent"><?= $student->getInitials();?></div>
				<?php endif;?>
				<div class="text">
					<h4><?= $student->getFullname() ;?></h4>
					<div class="wrap-social">
						<ul>
							<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
							<li><a href=""><i class="fab fa-twitter"></i></a></li>
							<li><a href=""><i class="fab fa-google"></i></a></li>
							<li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
						</ul>
                    </div>
					<div class="info">
						<ul>
							<li><i class="fas fa-envelope"></i><?= $student->getEmail() ;?></li>
						</ul>
                    </div>
					<a href="<?= path('showStudentDetails', $student->getId());?>" class="button">Profil complet</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end teacher single -->

	<div class="container">
		<?php if($skills):?>
			<div style="background-color: white">
				<table class="stripped">
					<thead>
						<tr>
							<th><h3>Liste des compétences</h3></th>
							<td colspan="4"/>
						</tr>
					</thead>
					<tbody>
						<?php foreach($skills as $skill):?>
							<tr>
								<td><?= $skill->getName();?></td>
								<?php foreach($skill->getCriterias() as $criteria):?>
									<td><?= $criteria ;?></td>
								<?php endforeach;?>
							<tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		<?php endif;?>
	</div>

	 <!-- features -->
	 <div class="features segments">
		<div class="container">
			<div class="row">
				<div class="col s6">
					<a href="<?= path('editStudent', $student->getId().'/'.$classroomid);?>">
						<div class="content">
                            <i class="fas fa-edit bg-blue"></i>
							<h5>Modifier</h5>
						</div>
					</a>
				</div>
				<div class="col s6">
					<a href="<?= path('deleteStudent', $student->getId());?>">
						<div class="content">
                            <i class="fas fa-trash bg-red"></i>
							<h5>Supprimer</h5>
						</div>
					</a>
				</div>	
			</div>
			
		</div>
	</div>

	<br/><br/><br/><br/>