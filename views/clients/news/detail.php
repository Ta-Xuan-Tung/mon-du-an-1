<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="mb-3"><?= htmlspecialchars($news['title']) ?></h1>
            <p class="text-muted mb-4">Đăng ngày: <?= date('d/m/Y', strtotime($news['created_at'])) ?></p>
            <img src="<?= ROOT_URL . $news['image'] ?>" class="img-fluid rounded mb-4" alt="<?= htmlspecialchars($news['title']) ?>">
            
            <div class="content">
                <?= nl2br(htmlspecialchars($news['content'])) // nl2br để hiển thị xuống dòng ?>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>