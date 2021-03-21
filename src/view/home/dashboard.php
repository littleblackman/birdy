<!-- slider -->
<div class="container">
	<div class="slide">
		<div class="slider-slide owl-carousel owl-theme">
			<div class="content">
				<div class="mask-red"></div>
				<img src="images/slider1.jpg" alt="">
				<div class="slider-caption">
					<h2>BIRDY</h2>
					<p>Automatisez vos tâches de formateur</p>
				</div>
			</div>
			<div class="content">
				<div class="mask-blue"></div>
				<img src="images/slider2.jpg" alt="">
				<div class="slider-caption">
					<h2>EASY</h2>
					<p>Notez les absents et créez vos comptes-rendus</p>
				</div>
			</div>
			<div class="content">
				<div class="mask-purple"></div>
				<img src="images/slider3.jpg" alt="">
				<div class="slider-caption">
					<h2>RAPIDE</h2>
					<p>Partagez et informez rapidement</p>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end slider -->


<!-- features -->
<div class="features segments">
	<div class="container">
		<div class="row">
			<div class="col s6">
				<a href="<?= path('session');?>">
					<div class="content">
						<i class="fas fa-briefcase bg-red"></i>
						<h5>Session</h5>
					</div>
				</a>
			</div>
			<div class="col s6">
				<a href="<?= path('classroom');?>">
					<div class="content">
						<i class="fas fa-user bg-purple"></i>
						<h5>Classe</h5>
					</div>
				</a>
			</div>			
		</div>		
	</div>
</div>
<!-- end features -->

<!-- latest news -->
<div class="latest-news segments">
	<div class="container">
		<div class="section-title">
			<h3>Dernières infos</h3>
		</div>
		<div class="row">
			<div class="col s6">
				<div class="content-text">
					<a href="blog-single.html"><h5>Prochaine session à venir</h5></a>
					<p class="date">20 décembre 2020 <span><i class="fas fa-ellipsis-v"></i>Admin</span></p>
					<div class="link-more">
						<a href="blog-single.html">Plus d'infos <i class="fas fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col s6">
				<div class="content-text">
					<a href="blog-single.html"><h5>Question sur la dernière session</h5></a>
					<p class="date">20 décembre 2020 <span><i class="fas fa-ellipsis-v"></i>Admin</span></p>
					<div class="link-more">
						<a href="blog-single.html">Plus d'infos <i class="fas fa-long-arrow-alt-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="services segments-page">
		<div class="container">
			<a href="<?= path('startSession');?>">
				<div class="content bg-blue">
					<div class="services-caption">
						<h4>Démarrer une session</h4>
					</div>
				</div>
			</a>
		</div>
</div>
<!-- end latest news -->
