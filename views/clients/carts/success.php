<?php 
// ĐÃ SỬA: Đường dẫn đúng không có thư mục "layouts"
include_once ROOT_DIR . 'views/clients/header.php'; 
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 500px;">
    <div class="card shadow-sm p-4 text-center border-0" style="max-width: 500px;">
        <div class="card-body">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#198754" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.02l-3.496 4.496-1.555-1.555a.75.75 0 0 0-1.06 1.06l2.085 2.085a.75.75 0 0 0 1.08-.02l4.02-5.18a.75.75 0 0 0-.02-1.08z"/>
                </svg>
            </div>
            <h3 class="card-title mb-3">Đặt hàng thành công!</h3>
            <p class="text-muted">
                Cảm ơn bạn đã tin tưởng và mua hàng tại website của chúng tôi. 
                Đơn hàng của bạn đã được ghi nhận và sẽ sớm được xử lý.
            </p>

            <div class="d-grid gap-3 mt-4">
                <a href="<?= ROOT_URL ?>" class="btn btn-primary btn-lg">Tiếp tục mua sắm</a>
                <a href="<?= ROOT_URL . '?ctl=order-history' ?>" class="btn btn-outline-secondary">Xem lịch sử đơn hàng</a>
            </div>
        </div>
    </div>
</div>

<?php 
// ĐÃ SỬA: Đường dẫn đúng không có thư mục "layouts"
include_once ROOT_DIR . 'views/clients/footer.php'; 
?>