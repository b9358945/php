<?php
require_once 'models/BoardModel.php';
require_once 'helpers/helpers.php';

class BoardController {
    private $model;

    public function __construct() {
        $this->model = new BoardModel();
    }

    public function displayBoard() {
        $posts_per_page = 10;
        $total_posts = $this->model->getTotalPosts();
        $total_pages = ceil($total_posts / $posts_per_page);
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        if ($current_page > $total_pages) {
            $current_page = $total_pages;
        }

        if ($current_page < 1) {
            $current_page = 1;
        }

        $start_index = ($current_page - 1) * $posts_per_page;
        $posts = $this->model->getPosts($start_index, $posts_per_page);

        require 'views/boardView.php';
    }

    // 아래는 글 수정
    public function showEditForm($name) {
        $post = $this->model->getPostByName($name);
        if (!$post) {
            die('해당 게시글을 찾을 수 없습니다.');
        }
        require 'views/editPostView.php';
    }

    public function updatePost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $comment = $_POST['comment'];

            $this->model->updatePostByName($name, $comment);
            header('Location: index.php'); // 업데이트 후 메인 페이지로 이동
            exit();
        }
    }


    // 아래는 글 삭제
    public function deletePost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $this->model->deletePostByName($name);
            header('Location: index.php'); // 삭제 후 메인 페이지로 이동
            exit();
        }
    }

}
