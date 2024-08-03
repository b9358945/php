<?php
require_once 'models/UserModel.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function showRegisterForm() {
        require 'views/registerView.php';
    }

    // 아래는 회원가입
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->model->registerUser($username, $email, $password)) {
                header('Location: index.php'); // 회원가입 후 메인 페이지로 이동
                exit();
            } else {
                echo "Registration failed. Please try again.";
            }
        } else {
            $this->showRegisterForm();
        }
    }

    // 아래는 로그인
    public function showLoginForm() {
        require 'views/loginView.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->model->authenticateUser($email, $password);

            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: index.php'); // 로그인 후 메인 페이지로 이동
                exit();
            } else {
                $error_message = "Invalid email or password. Please try again.";
                require 'views/loginView.php';
            }
        } else {
            $this->showLoginForm();
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php');
        exit();
    }



}
