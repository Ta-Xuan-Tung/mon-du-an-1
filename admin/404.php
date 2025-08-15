<?php 
// Nạp header của trang admin để giao diện nhất quán
include_once ROOT_DIR . "views/admin/header.php"; 
?>

<div class="container-fluid">
    <div class="text-center mt-5">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Trang không tồn tại</p>
        <p class="text-gray-500 mb-0">Có vẻ như bạn đã đi vào một đường dẫn không có thật...</p>
        <a href="<?= ADMIN_URL ?>">&larr; Quay lại trang Dashboard</a>
    </div>
</div>

<?php 
// Nạp footer của trang admin
include_once ROOT_DIR . "views/admin/footer.php"; 
?>