<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<div class="container mt-4">
    <h3>Thêm mới sản phẩm</h3>
    <form action="<?= ADMIN_URL . '?ctl=product-store' ?>" method="post" enctype="multipart/form-data" class="mt-4">
        
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="name" class="form-label"><strong>Tên sản phẩm</strong></label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label"><strong>Mô tả ngắn</strong></label>
                    <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label"><strong>Nội dung chi tiết</strong></label>
                    <textarea name="content" id="content" rows="8" class="form-control"></textarea>
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="category_id" class="form-label"><strong>Danh mục</strong></label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">-- Chọn danh mục --</option>
                        <?php foreach($categories as $cate) : ?>
                            <option value="<?= $cate['id']?>"><?= $cate['cate_name']?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label"><strong>Giá</strong></label>
                    <input type="number" name="price" step="1" min="0" class="form-control" id="price" required>
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label"><strong>Hình ảnh</strong></label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Trạng thái</strong></label>
                    <div>
                        <input type="radio" name="status" value="1" id="status_active" checked>
                        <label for="status_active">Đang kinh doanh</label>
                    </div>
                    <div>
                        <input type="radio" name="status" value="0" id="status_inactive">
                        <label for="status_inactive">Ngừng kinh doanh</label>
                    </div>
                </div>
            </div>
        </div>
        
        <hr>

        <h4>Quản lý Kho hàng (Size và Số lượng)</h4>
        <div id="size-container" class="mt-3">
            </div>
        <button type="button" id="add-size-btn" class="btn btn-primary mt-2">Thêm Size</button>

        <hr>

        <div class="mb-3 mt-4">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Thêm mới
            </button>
            <a href="<?= ADMIN_URL . '?ctl=product-list' ?>" class="btn btn-secondary">Quay lại danh sách</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('size-container');
    const addBtn = document.getElementById('add-size-btn');

    addBtn.addEventListener('click', function () {
        const newSizeRow = document.createElement('div');
        newSizeRow.className = 'row mb-2 align-items-center';
        newSizeRow.innerHTML = `
            <div class="col-md-5">
                <label class="form-label small">Size (ví dụ: 39, 40, S, M)</label>
                <input type="text" name="sizes[]" class="form-control" placeholder="Nhập size" required>
            </div>
            <div class="col-md-5">
                <label class="form-label small">Số lượng</label>
                <input type="number" name="quantities[]" class="form-control" placeholder="Nhập số lượng" required min="0">
            </div>
            <div class="col-md-2 pt-4">
                <button type="button" class="btn btn-sm btn-danger remove-size-btn">
                    <i class="bi bi-trash"></i> Xóa
                </button>
            </div>
        `;
        container.appendChild(newSizeRow);
    });

    container.addEventListener('click', function (e) {
        if (e.target.closest('.remove-size-btn')) {
            e.target.closest('.row').remove();
        }
    });
});
</script>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>