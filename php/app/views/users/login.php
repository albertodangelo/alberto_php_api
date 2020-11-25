<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register_success'); ?>
            <h2>Login</h2>
            <form method="post" action="<?php echo URLROOT . '/users/login' ?>">
               
                <div class="form-group">
                    <label for="email">E-Mail: <sup>*</sup></label>
                    <input type="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" name="email" value="<?php echo $data['email'] ?>" >
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Passwort: <sup>*</sup></label>
                    <input type="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" name="password" value="<?php echo $data['password'] ?>" >
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>
               
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Anmelden" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT . '/users/register' ?>" class="btn btn-light btn-block">Registrieren</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>