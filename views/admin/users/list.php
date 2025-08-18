<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<div class="container mt-4">
    <h3>Quản lý Người dùng</h3>

    <?php if (!empty($message)) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($message) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <table class="table table-bordered table-striped mt-4">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Họ và Tên</th>
                <th scope="col">Email</th>
                <th scope="col">Vai trò</th>
                <th scope="col">Trạng thái</th>
                <th scope="col" style="width: 15%;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <th scope="row"><?= $user['id'] ?></th>
                    <td><?= htmlspecialchars($user['fullname']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <?php if ($user['role'] == 'admin'): ?>
                            <span class="badge bg-danger">Quản trị viên</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Khách hàng</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($user['active'] == 1): ?>
                            <span class="badge bg-success">Đang hoạt động</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Bị vô hiệu hóa</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php
                        // Vẫn giữ lại cải tiến: Nếu là admin đang đăng nhập, ô này sẽ để trống
                        if ($_SESSION['user']['id'] != $user['id']) {
                            if ($user['active'] == 1) {
                                $url = ADMIN_URL . '?ctl=user-update-status&id=' . $user['id'] . '&status=0';
                                $confirm_text = 'Bạn có chắc muốn vô hiệu hóa tài khoản này?';
                                echo '<a href="' . $url . '" class="btn btn-sm btn-danger" onclick="return confirm(\'' . $confirm_text . '\')">Vô hiệu hóa</a>';
                            } else {
                                $url = ADMIN_URL . '?ctl=user-update-status&id=' . $user['id'] . '&status=1';
                                $confirm_text = 'Bạn có chắc muốn kích hoạt lại tài khoản này?';
                                echo '<a href="' . $url . '" class="btn btn-sm btn-success" onclick="return confirm(\'' . $confirm_text . '\')">Kích hoạt</a>';
                            }
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>