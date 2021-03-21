
<div class="container">
    <a href="<?= path('showClassroom', $classroomid);?>">
        <div class="functionBar">
            Retour à la classe
        </div>
    </a>
    <!-- teacher single -->
        <div class="teacher-single segments-page">
            <div class="container">
                <div class="content">
                    <input type="hidden" id="inputstudentid" value="<?= $student->getId();?>"/>
                    <form action="#" id="formImg" enctype="multipart/form-data">
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>Photo</span>
                                <input type="file" id="inputStudentImg" name="inputImg">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </form>
                    <div id="showImg">
                        <img src="<?= ASSETS.$student->getAvatar();?>" alt="">
                    </div>
                    <div class="text">
                        <h4>
                            <input type="text" placeholder="Prénom" value="<?= $student->getFirstname();?>" name="firstname" class="inputdatas"/>
                            <input type="text" placeholder="Nom" value="<?= $student->getLastname();?>" name="lastname" class="inputdatas"/>
                        </h4>
                        <div class="wrap-social">
                            <ul>
                                <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                <li><a href=""><i class="fab fa-google"></i></a></li>
                                <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <div class="commands">
                        <i class="fas fa-chevron-left" onclick="showPrevStudent(<?= $student->getId();?>)"></i>
                        <i class="fas fa-chevron-right" onclick="showNextStudent(<?= $student->getId();?>)"></i>
                        </div>
                        <div class="info">
                            <ul>
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <input type="text" value="<?= $student->getEmail() ;?>" placeholder="email" name="email" class="inputdatas">
                                </li>
                            </ul>
                        </div>
                        <a href="<?= path('showStudentDetails', $student->getId());?>" class="button">Profil complet</a>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- end teacher single -->

 <!-- features -->
    <div class="features segments">
		<div class="container">
			<div class="row">
				<div class="col s12">
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