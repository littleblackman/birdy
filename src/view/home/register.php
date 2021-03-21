<!-- register -->
<div class="register segments-page">
    <div class="container">
        <div class="contact-title">
            <h3>Register</h3>
        </div>
        <div class="wrap-form">
            <form action = "<?= path('createUser');?>" method = "POST">
                <input type="text" placeholder="First Name" name="data[firstname]">
                <input type="text" placeholder="Last Name" name="data[lastname]">
                <input type="Email" placeholder="Email" name="data[email]">
                <input type="password" placeholder="Password" name="data[password]">
                <!--<input type="password" placeholder="Retype Password">-->
                <input type="submit" class="" value="Register"/>

            </form>
        </div>
        <div class="info">
            <p>Have an account?<span><a href="<?= path('home');?>">Login</a></span></p>
        </div>
    </div>
</div>
<!-- end register -->