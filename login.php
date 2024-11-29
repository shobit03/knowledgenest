<?php include('./panels/header-top.php') ?>
<title> Login </title>
<meta name="description" content="Login">
<?php include('./panels/header-bottom.php') ?>


<!--  Sign in Section Start-->
<div class="sign-in-section ptb-100">
    <div class="container">
        <div class="main-max-width">
            <div class="sign-content">
                <div class="box-content text-center mb-30">
                    <h4>Welcome back</h4>
                    <p>Hey there! Ready to log in? Just enter your username and password below and you'll be back in action in no time. Let's go!</p>
                </div>

                <div class="text-sin text-center position-relative mb-10">
                    <p class="mb-0">Or Sign in with Email</p>
                </div>
                <div class="log-from mb-30">
                    <form action="#">
                        <div class="form-group mb-15">
                            <label class="label-style">Your email</label>
                            <input type="email" placeholder="Your email" class="bg-white input-style border-style w-100 h-60">
                        </div>
                        <div class="form-group mb-30">
                            <label class="label-style">Password</label>
                            <input type="text" placeholder="Enter your password" class="bg-white input-style border-style w-100 h-60">
                        </div>
                        <div class="meta-info d-flex justify-content-between mb-20">
                            <div class="form-check edu-check">
                                <input class="form-check-input edu-check-input" type="checkbox" value="" id="defaultCheck4">
                                <label class="form-check-label edu-check-label" for="defaultCheck4">
                                    I agree to the terms of service
                                </label>
                            </div>
                            <a href="sign-up.html">Forget password?</a>
                        </div>
                        <button type="submit" class="btn style-one w-100 box-shadow-1">Login</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<!--  Sign in Section End-->


<?php include('./panels/footer-bottom.php') ?>