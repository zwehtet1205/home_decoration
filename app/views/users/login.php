<?php 
ini_set('display_errors', 1);
require APPURL.'/views/layout/header.php'; 
?>

<section class="col-md-4 mx-auto py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light rounded-0">
                <div class="card-body">
                    <?php flash('register_success'); ?>

                    <h3 class="text-center">Login</h3>
                    <form action="<?php echo ROOTURL; ?>/users/login" method="POST">
                        <div class="col-md-12 form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0 <?php echo (!empty($datas['emailerr'])) ? 'is-invalid' : ''; ?>" placeholder="Enter Email Address" value="<?php echo $datas['email']; ?>" />
                            <span class="invalid-feedback"><?php echo $datas['emailerr']; ?></span>
                        </div>

                        <div class="col-md-12 form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-sm rounded-0 <?php echo (!empty($datas['passworderr'])) ? 'is-invalid' : ''; ?>" placeholder="Enter password" value="<?php echo $datas['password']; ?>" />
                            <span class="invalid-feedback"><?php echo $datas['passworderr']; ?></span>
                        </div>

                        <div class="row">
                            <div class="col">
                                <a href="<?php echo ROOTURL; ?>/users/register">Not yet registered? Register here.</a>
                            </div>
                            <div class="col text-end">
                                <button type="submit" class="btn btn-primary btn-sm rounded-0">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require APPURL.'/views/layout/footer.php'; ?>
    