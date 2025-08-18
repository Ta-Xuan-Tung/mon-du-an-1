<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<h3 class="my-4">Quản lý Tin tức</h3>
<a href="<?= ADMIN_URL ?>?ctl=news-create" class="btn btn-primary mb-3">Thêm bài viết mới</a>

<?php if (!empty($message_success)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($message_success) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th><th>Tiêu đề</th><th>Ảnh</th><th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($newsList as $news): ?>
        <tr>
            <td><?= $news['id'] ?></td>
            <td><?= htmlspecialchars($news['title']) ?></td>
            <td><img src="<?= ROOT_URL . $news['image'] ?>" height="60"></td>
            <td>
                <a href="<?= ADMIN_URL ?>?ctl=news-edit&id=<?= $news['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="<?= ADMIN_URL ?>?ctl=news-delete&id=<?= $news['id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= ADMIN_URL ?>?ctl=news-list&page=<?= $page - 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="<?= ADMIN_URL ?>?ctl=news-list&page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= ADMIN_URL ?>?ctl=news-list&page=<?= $page + 1 ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>