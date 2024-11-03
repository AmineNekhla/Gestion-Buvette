<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="mb-4">Comments</h1>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<form action="/comments/store" method="post">
    <?= csrf_field(); ?>
    <div class="form-group">
        <textarea class="form-control" name="content" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Leave a Comment</button>
</form>

<h2 class="mt-4">All Comments</h2>
<ul class="list-group">
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <li class="list-group-item">
                <strong><?= esc($comment['username']) ?></strong> 
                <p><?= esc($comment['content']) ?></p>
                <small>Posted on: <?= esc($comment['created_at']) ?></small>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li class="list-group-item">No comments yet.</li>
    <?php endif; ?>
</ul>

<?= $this->endSection() ?>
