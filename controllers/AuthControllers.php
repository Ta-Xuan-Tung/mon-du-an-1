<?php

class AuthControllers {
    //Đăng ký
    public function register(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $_POST;
            //Mã hóa mật khẩu
            $password = $_POST['password'];
            $password = password_hash($password, PASSWORD_DEFAULT);

            //đưa vào data
            $data['password'] = $password;

            //insert vào db
            (new User)->create($data);

            //thông báo thành công
            $_SESSION['message'] = "Đăng ký thành công!";
            header('Location: ' . ROOT_URL . '?ctl=login');
            die;
        }

        return view('clients.users.register');
    }

    //Đăng nhập
    public function login(){
        //kiểm tra đã đăng nhập chưa
        if (isset($_SESSION['user'])){
            header('Location: ' . ROOT_URL );
            die;
        }
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = (new User)->findUserOfEmail($email);

            //kiểm tra mật khẩu
            if ($user){
                if(password_verify($password, $user['password'])){
                    //đăng nhập thành công
                    $_SESSION['user'] = $user;
                    //nếu role = admin, vào admin, ngược lại vào trang chủ
                    if($user['role'] == 'admin'){
                        header("Loaction: ". ADMIN.URL );
                        die;
                    }
                    header("Loaction: ". ROOT.URL );
                        die;
                }else{
                    $error = "Email hoặc Mật khẩu không đúng!"; 
                }
            }else{
                $error = "Email hoặc Mật khẩu không đúng!"; 
            }
        }
        $message = session_flash('message');
        return view('clients.users.login', compact('message', 'error'));
    }

    //đăng xuất
    public function logout(){
        unset($_SESSION['user']);
        header('Location: ' . ROOT_URL . '?ctl=login');
        die;
    }
}