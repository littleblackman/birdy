
	<!-- navbar -->
	<div class="navbar">
		<div class="container">
			<div class="row">
				<div class="col s6">
					<div class="content-left" style="display: flex;">
						<?php if($app_session->getRequest()->getRoute() != ""):?>
							<a href="javascript:history.back()" class="backbutton">
								<i class="fas fa-caret-square-left color-indigo1" style="font-size: 22px"></i>
							</a>
							&nbsp;&nbsp;&nbsp;
						<?php endif;?>
						<a href="<?= path('home');?>">
							<h1>
								<span class="color-indigo1">B</span>
								<span class="color-indigo2">I</span>
								<span class="color-indigo3">R</span>
								<span class="color-indigo4">D</span>
								<span class="color-indigo5">Y</span>	
						
							</h1>
						</a>
					</div>
				</div>
				<div class="col s6">
					<?php if($app_session->isLogged()):?>
						<div class="content-right">
							<a href="#slide-out" data-activates="slide-out" class="sidebar"><i class="fas fa-bars"></i></a>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
	<!-- end navbar -->

	<?php if($app_session->isLogged()):?>

		<!-- sidebar left -->
		<div class="sidebar-panel">
			<ul id="slide-out" class="collapsible side-nav">
				<li class="list-top">
					<div class="user-view">
						<img class="responsive-img" src="<?= ASSETS;?>edugo/images/testimonial1.png" alt="">
						<h4><?= $app_session->getFullname();?></h4>
						<span><?= ucfirst($app_session->getRole());?></span>
					</div>
				</li>
				<li><a href="<?= path('home');?>"><i class="fas fa-home"></i>Accueil</a></li>
				<li><a href="#"><i class="fas fa-user"></i>Profil</a></li>
				<li><a href="#"><i class="fas fa-cogs"></i>Réglages</a></li>

			
				<li><a href="<?= path('cycle');?>"><i class="fas fa-graduation-cap"></i>Cycles</a></li>
				<li><a href="#"><i class="fas fa-file"></i>Rapports</a></li>

				<li><a href="#"><i class="fas fa-calendar-alt"></i>Evènements</a></li>
				<li><a href="#"><i class="fas fa-clone"></i>Ressources</a></li>

				<li><a href="<?= path('logout') ;?>"><i class="fas fa-sign-out-alt"></i>Déconnexion</a></li>
			</ul>
		</div>
		<!-- end sidebar left -->
	<?php endif;?>