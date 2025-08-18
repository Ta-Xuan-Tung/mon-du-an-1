<?php include_once ROOT_DIR . "views/admin/header.php"; ?>
<h3 class="my-4">Sửa bài viết</h3>
<form action="<?= ADMIN_URL ?>?ctl=news-update" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $news['id'] ?>">
    <div class="mb-3"><label class="form-label">Tiêu đề:</label><input type="text" name="title" class="form-control" value="<?= htmlspecialchars($news['title']) ?>" required></div>
    <div class="mb-3"><label class="form-label">Ảnh đại diện (Để trống nếu không muốn đổi):</label><input type="file" name="image" class="form-control"> <br> <img src="<?= ROOT_URL . $news['image'] ?>" height="100"></div>
    <div class="mb-3"><label class="form-label">Nội dung:</label><textarea name="content" class="form-control" rows="8" required><?= htmlspecialchars($news['content']) ?></textarea></div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>