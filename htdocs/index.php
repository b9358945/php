<?php
require_once 'controllers/BoardController.php';
require_once 'controllers/UserController.php';

$boardController = new BoardController();
$userController = new UserController();

// action 파라미터를 사용하여 라우팅
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'edit_post':
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $boardController->showEditForm($name);
        break;
    
    case 'update_post':
        $boardController->updatePost();
        break;

    case 'delete_post':
        $boardController->deletePost();
        break;        

    case 'register':
        $userController->register();
        break;

    case 'show_register':
        $userController->showRegisterForm();
        break;

    case 'login':
        $userController->login();
        break;

    case 'show_login':
        $userController->showLoginForm();
        break;

    case 'logout':
        $userController->logout();
        break;

    default:
        $boardController->displayBoard();
        break;
}
