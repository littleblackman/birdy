<!-- login -->
<div class="login segments-page">
	<div class="container">
		<div class="contact-title">
			<h3>Connexion</h3>
		</div>
		<div class="wrap-form">
			<form action = "<?= path('auth');?>" method="POST">
				<input type="text" placeholder="Email" name="data[email]">
				<input type="password" placeholder="Mot de passe" name="data[password]">
				<input type="submit" class="fullwdith red darken-1 white-text" value="Login">
			</form>
		</div>
		<div class="info">
			<ul>
				<li>Vous n'avez pas de compte ?
					<a href="<?= path('register');?>">Créez un compte</a>
				</li>
				<li>
					<a href="forgot-password.html">Mot de passe oublié</a>
				</li>
			</ul>
		</div>
		
	</div>
</div>
<!-- end login -->
