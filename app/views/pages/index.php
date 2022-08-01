<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="jumbotron">
    <h1 class="display-4"><?php echo $data['title']; ?></h1>
    <p class="lead"><?php echo $data['description']; ?></p>
    <hr class="my-4">
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="<?php echo URLROOT; ?>/posts" role="button">View Posts</a>
    </p>
</div>
<?php require APPROOT . '/views/includes/footer.php'; ?>