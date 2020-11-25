<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> zurück</a>
<br />
<?php // print_r($data); ?>
<div class="h1"><?php echo $data->title; ?></div>
<div class="bg-secondary text-white p-2 mb-3">
    Beitrag von <?php echo $data->name ?> vom <?php echo $data->postCreated; ?>
</div>

<p><?php echo $data->body; ?></p>

<?php if($data->userId === $_SESSION['user_id']) : ?>
    <a href="<?php URLROOT;?>/posts/edit/<?php echo $data->postId ?>" class="btn btn-dark">ändern</a>
    <a href="<?php URLROOT;?>/posts/delete/<?php echo $data->postId ?>" style="float:right;" class="btn btn-danger push-right">löschen</a>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?> 