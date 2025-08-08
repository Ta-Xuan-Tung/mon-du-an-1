<?php

class AuthControllers {

    /**
     * Hiển thị form đăng ký & xử lý đăng ký
     */
    public function register() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            
            // 1. Kiểm tra xem email đã tồn tại chưa
            $existingUser = $userModel->findByEmail($_POST['email']);
            if ($existingUser) {
                $error = 'Email này đã được sử dụng!';
            } else {
                // 2. Nếu email chưa tồn tại, tiến hành tạo tài khoản
                $data = [
                    'fullname' => $_POST['fullname'],
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'phone' => $_POST['phone'] ?? '',
                    'address' => $_POST['address'] ?? '',
                    'role' => 'customer',
                    'active' => 1
                ];
    
                $userModel->create($data);
    
                $_SESSION['message'] = "Đăng ký thành công! Vui lòng đăng nhập.";
                header('Location: ' . ROOT_URL . '?ctl=login');
                die;
            }
        }

        // SỬA LẠI ĐƯỜNG DẪN VIEW
        return view('clients.users.register', ['error' => $error]);
    }

    /**
     * Hiển thị form đăng nhập & xử lý đăng nhập
     */
    public function login() {
        if (isset($_SESSION['user'])) {
            header('Location: ' . ROOT_URL);
            die;
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // **SỬA LỖI Ở ĐÂY: Dùng đúng tên hàm findByEmail()**
            $user = (new User)->findByEmail($email);
    
            if (!$user) {
                $error = "Email hoặc mật khẩu không chính xác.";
            } else if ($user['active'] == 0) {
                $error = "Tài khoản của bạn đã bị khóa.";
            } else if (!password_verify($password, $user['password'])) {
                $error = "Email hoặc mật khẩu không chính xác.";
            } else {
                $_SESSION['user'] = $user;

                if ($user['role'] == 'admin') {
                    header("Location: " . ADMIN_URL);
                    die;
                }
                header("Location: " . ROOT_URL);
                die;
            }
        }
        
        $message = session_flash('message');
        // SỬA LẠI ĐƯỜNG DẪN VIEW
        return view('clients.users.login', compact('message', 'error'));
    }

    /**
     * Đăng xuất
     */
    public function logout() {
        unset($_SESSION['user']);
        header('Location: ' . ROOT_URL);
        die;
    }

    /**
     * Cập nhật thông tin cá nhân (Profile)
     */
    public function updateProfile() {
        $id = $_SESSION['user']['id'];
        $data = [
            'id'       => $id,
            'fullname' => $_POST['fullname'],
            'phone'    => $_POST['phone'],
            'address'  => $_POST['address'],
        ];

        (new User)->update($id, $data);
        
        $_SESSION['user'] = (new User)->find($id);

        $_SESSION['message'] = 'Cập nhật thông tin thành công!';
        header('Location: '. ROOT_URL . '?ctl=profile');
        die;
    }
}