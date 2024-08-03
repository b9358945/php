<?php
class BoardModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "board");
        $this->db->set_charset("utf8");
        if ($this->db->connect_error) {
            die("Database connection failed: " . $this->db->connect_error);
        }
    }

    // 전체 게시글 수 가져오기
    public function getTotalPosts() {
        $query = "SELECT COUNT(*) as count FROM board";
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        return $row['count'];
    }

    // 특정 페이지에 대한 게시글 목록 가져오기
    public function getPosts($start_index, $posts_per_page) {
        $query = "SELECT * FROM board ORDER BY score DESC LIMIT $start_index, $posts_per_page";
        return $this->db->query($query);
    }

    public function getPostByName($name) {
        $stmt = $this->db->prepare("SELECT * FROM board WHERE name = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->error);
        }
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // 게시글 수정
    public function updatePostByName($name, $comment) {
        $stmt = $this->db->prepare("UPDATE board SET comment = ? WHERE name = ?");
        $stmt->bind_param("ss", $comment, $name);
        return $stmt->execute();
    }

    public function deletePostByName($name) {
        $stmt = $this->db->prepare("DELETE FROM board WHERE name = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->error);
        }
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }


    public function __destruct() {
        $this->db->close();
    }
}
