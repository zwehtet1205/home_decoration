
<?php require APPURL.'/views/layout/header.php'; ?>

<?php ini_set('display_errors', 1); ?>

<section class="col-md-4 mx-auto py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light rounded-0">
                <div class="card-body">
                    <h3 class="text-center">Register Form</h3>
                    <form action="<?php echo ROOTURL; ?>/users/register" method="POST">

                        <div class="col-md-12 form-group mb-3">
                            <label for="fullname">Full Name</label>
                            <input type="text" name="fullname" id="fullname" class="form-control form-control-sm rounded-0 <?php echo (!empty($datas['fullnameerr'])) ? 'is-invalid' : ''; ?>" placeholder="Enter fullname" value="<?php echo $datas['fullname']; ?>"/>
                            <span class="invalid-feedback"><?php echo $datas['fullnameerr']; ?></span>
                        </div>

                        <div class="col-md-12 form-group mb-3">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control form-control-sm rounded-0 <?php echo (!empty($datas['emailerr'])) ? 'is-invalid' : ''; ?>" placeholder="Enter Email Address" value="<?php echo $datas['email']; ?>"/>
                            <span class="invalid-feedback"><?php echo $datas['emailerr']; ?></span>
                        </div>

                        <div class="col-md-12 form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-sm rounded-0 <?php echo (!empty($datas['passworderr'])) ? 'is-invalid' : ''; ?>" placeholder="Enter password" value="<?php echo $datas['password']; ?>"/>
                            <span class="invalid-feedback"><?php echo $datas['passworderr']; ?></span>
                        </div>

                        <div class="col-md-12 form-group mb-3">
                            <label for="cfmpassword">Confirm Password</label>
                            <input type="password" name="cfmpassword" id="cfmpassword" class="form-control form-control-sm rounded-0 <?php echo (!empty($datas['cfmpassworderr'])) ? 'is-invalid' : ''; ?>" placeholder="Confirm password" value="<?php echo $datas['cfmpassword']; ?>"/>
                            <span class="invalid-feedback"><?php echo $datas['cfmpassworderr']; ?></span>
                        </div>

                        <div class="row">
                            <div class="col">
                                <a href="<?php echo ROOTURL; ?>/users/login">Already have an account? Login here.</a>
                            </div>
                            <div class="col text-end">
                                <button type="submit" class="btn btn-primary btn-sm rounded-0">Register</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require APPURL.'/views/layout/footer.php'; ?>
    