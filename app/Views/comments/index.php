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
                <p>Rating: 
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <?php if ($comment['rating'] >= $i): ?>
                            <span class="text-warning">&#9733;</span> <!-- filled star -->
                        <?php else: ?>
                            <span>&#9734;</span> <!-- empty star -->
                        <?php endif; ?>
                    <?php endfor; ?>
                </p>
                <small>Posted on: <?= esc($comment['created_at']) ?></small>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li class="list-group-item">No comments yet.</li>
    <?php endif; ?>
</ul>
<br><br>

<form action="/comments/store" method="post">
    <?= csrf_field(); ?>
    <div class="form-group">
        <textarea class="form-control" name="content" rows="4" required></textarea>
    </div>

    <!-- Rating stars -->
    <div class="form-group">
        <label for="rating">Rating:</label><br>
        <div class="star-rating">
            <input type="radio" name="rating" value="1" id="star1"><label for="star1">&#9733;</label>
            <input type="radio" name="rating" value="2" id="star2"><label for="star2">&#9733;</label>
            <input type="radio" name="rating" value="3" id="star3"><label for="star3">&#9733;</label>
            <input type="radio" name="rating" value="4" id="star4"><label for="star4">&#9733;</label>
            <input type="radio" name="rating" value="5" id="star5"><label for="star5">&#9733;</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary" style="background-color: #2C3E50;">Leave a Comment</button>
</form>

<?= $this->endSection() ?>

<!-- Add CSS for star rating -->
<style>
    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        font-size: 24px;
        color: #ccc;
        cursor: pointer;
    }

    .star-rating input[type="radio"]:checked ~ label {
        color: #FFD700;
    }

    .star-rating input[type="radio"]:checked ~ label ~ label {
        color: #FFD700;
    }

    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #FFD700;
    }
</style>
