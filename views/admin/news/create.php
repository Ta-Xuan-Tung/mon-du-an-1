<?php include_once ROOT_DIR . "views/admin/header.php"; ?>
<h3 class="my-4">Thêm bài viết mới</h3>
<form action="<?= ADMIN_URL ?>?ctl=news-store" method="POST" enctype="multipart/form-data">
    <div class="mb-3"><label class="form-label">Tiêu đề:</label><input type="text" name="title" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Ảnh đại diện:</label><input type="file" name="image" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Nội dung:</label><textarea name="content" class="form-control" rows="8" required></textarea></div>
    <button type="submit" class="btn btn-primary">Lưu</button>
     <a href="<?= ADMIN_URL ?>?ctl=news-list" class="btn btn-secondary">Hủy</a>
</form>
<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>