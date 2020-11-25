<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> zurück</a>

<div class="card card-body bg-light mt-5">
    <h2>Neuer Beitrag</h2>
    <form method="post" action="<?php echo URLROOT . '/posts/add' ?>">
        <div class="form-group">
            <label for="title">Titel: <sup>*</sup></label>
            <input type="text" class="form-control form-control-lg <?php print(!empty($data['name_err']) ? 'is-invalid' : ''); ?>" name="title" value="<?php echo $data['title'] ?>" >
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="body">Beitragstext: <sup>*</sup></label>
            <textarea  class="form-control form-control-lg <?php print(!empty($data['body_err']) ? 'is-invalid' : ''); ?>" name="body" ><?php echo $data['body'] ?></textarea>
            <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
        </div>
        <div class="row">
            <div class="col">
                <input type="submit" value="absenden" class="btn btn-success btn-block">
            </div>
        </div>
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>