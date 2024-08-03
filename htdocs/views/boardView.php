<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>

<body>
    <div class="menu">
        <nav>
            <ul>
                <li><a href="http://127.0.0.1/index.php">Home</a></li>
                <li><a href="">Challenge</a></li>
                <li><a href="">Ranking</a></li>
                <li><a href="">Hall of Fame</a></li>
                <li><a href="">Contact</a></li>
                <?php
                session_start(); // 세션 시작
                if (isset($_SESSION['username'])) {
                    // 로그인 상태일 경우 사용자 이름 표시
                    echo '<li><a href="index.php?action=logout">로그아웃 (' . htmlspecialchars($_SESSION['username']) . ')</a></li>';
                } else {
                    // 로그인하지 않은 상태일 경우 로그인 링크 표시
                    echo '<li><a href="index.php?action=show_login">로그인</a></li>';
                    echo '<li><a href="index.php?action=show_register">회원가입</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>

    <div class="table-container">
        <table class="table">
            <tr class="specialtable">
                <td colspan="5"><p class="h3">😎</p></td>
            </tr>
            <tr class="header">
                <th>#</th>
                <th>Name</th>
                <th>Score</th>
                <th>Comment</th>
                <th>Lastauth</th>
            </tr>
            <tbody>
                <?php
                if ($posts->num_rows > 0) {
                    $rank = $start_index + 1;
                    while($board = $posts->fetch_assoc()) {
                ?>
                    <tr>
                        <td>
                            <?php
                            if ($rank == 1) echo "&#129351;";
                            else if ($rank == 2) echo "&#129352;";
                            else if ($rank == 3) echo "&#129353;";
                            else echo htmlspecialchars($rank); 
                            ?>
                        </td>
                        <td>
                            <a href="index.php?action=edit_post&name=<?php echo urlencode($board['name']); ?>">
                                <?php echo htmlspecialchars($board['name']); ?>
                            </a>
                        </td>
                        <td><?php echo htmlspecialchars($board['score']); ?></td>
                        <td><?php echo make_links_clickable(htmlspecialchars($board['comment'])); ?></td>
                        <td><?php echo htmlspecialchars($board['lastauth']); ?></td>
                    </tr>
                <?php
                        $rank++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div>
        <?php
        if ($total_pages > 1): ?>
            <ul class="pagination">
                <?php for ($page_num = 1; $page_num <= $total_pages; $page_num++): ?>
                    <?php if ($page_num != $current_page): ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?page=<?php echo $page_num; ?>"><?php echo $page_num; ?></a>
                        </li>
                    <?php else: ?>
                        <li class="page-item active">
                            <a class="page-link" href="index.php?page=<?php echo $page_num; ?>"><?php echo $page_num; ?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>
            </ul>
        <?php endif; ?>
    </div>
</body> 
</html>
