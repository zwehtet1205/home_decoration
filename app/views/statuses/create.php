<?php require APPURL.'/views/layout/header.php'; ?>

<section class = "col-md-4 mx-auto py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light rounded-0">
                <div class="card-body">
                    <?php flash('register_success') ?>

                    <h3 class="text-center">Login</h3>
                    <form action="<?php echo ROOTURL; ?>/statuses/create" method="POST">
                        <div class="col-md-10 form-group mb-3">
                            <label for="name">Status Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0 <?php echo (!empty($datas['name'])) ? 'is-invalid' : '' ?> " placeholder="Enter status name" value="<?php echo $datas['name']?>"/>
                            <span class="invalid-feedback"><?php echo $datas['name'] ?></span>
                        </div>

                        <div class="col text-end">
                            <button type="submit" class="btn btn-primary btn-sm rounded-0">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require APPURL.'/views/layout/footer.php'; ?>
    