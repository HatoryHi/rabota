<?php include_once(BACK_END_STYLES); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Sign In</h5>
                    <form class="form-signin" action="<?php echo LOGIN_URL ?>" method="post">
                        <div class="form-label-group">
                            <label for="login">Login</label>
                            <input type="text" id="login" name="login" class="form-control" placeholder="Login" required
                                   autofocus>
                        </div>
                        <br>
                        <div class="form-label-group">
                            <label for="pass">Password</label>
                            <input type="password" id="pass" name="password" class="form-control" placeholder="Password"
                                   required>
                        </div>
                        <br>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>