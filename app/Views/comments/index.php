<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card-header text-center text-white py-3" style="background-color: #ABDACA;">
            <h2 class="mb-0">Comments</h2>
        </div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>


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
<br>
    <br>
    

<form action="/comments/store" method="post">
    <?= csrf_field(); ?>
    <div class="form-group">
        <textarea class="form-control" name="content" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary" style="background-color: #2C3E50;">Leave a Comment</button>
</form>


<?= $this->endSection() ?>
