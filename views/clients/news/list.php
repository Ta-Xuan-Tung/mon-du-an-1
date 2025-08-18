<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center">Tin tức & Bài viết</h2>

    <div class="row">
        <?php foreach($newsList as $news): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <a href="<?= ROOT_URL ?>?ctl=news-detail&id=<?= $news['id'] ?>">
                        <img src="<?= ROOT_URL . $news['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($news['title']) ?>">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="<?= ROOT_URL ?>?ctl=news-detail&id=<?= $news['id'] ?>" class="text-decoration-none text-dark">
                                <?= htmlspecialchars($news['title']) ?>
                            </a>
                        </h5>
                        <p class="card-text text-muted">
                            <small>Đăng ngày: <?= date('d/m/Y', strtotime($news['created_at'])) ?></small>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>