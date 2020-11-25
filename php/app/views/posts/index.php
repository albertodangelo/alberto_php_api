
<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('post_added'); ?>
<div class="row">


    <div class="col-md-6 mb-3">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT . '/posts/add'; ?>" style="float: right;" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Neuen Post eröffnen
        </a>
    </div>
</div>

<?php foreach($data['posts'] as $post) : ?>
    <div class="card card-body mb-3">
        <h4><?php echo $post->title ?></h4>
        <div class="bg-light p-2 mb-3">
            Gepostet von <?php echo $post->name; ?> am <?php echo $post->postCreated ?>
        </div>
        <p class="card-text"><?php echo $post->body ?></p>
        <a href="<?php echo URLROOT;?>/posts/show/<?php echo $post->postId ?>" class="btn btn-dark">Details</a>
    </div>
<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?> 