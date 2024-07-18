<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
<style>
    /* 테이블 */
    
    .table-container {
        width: 80%; /* 테이블 컨테이너 너비 설정 */
        margin: 80px auto; /* 상단바 높이와 테이블 사이 여백 추가 */
        overflow-x: auto; /* 가로 스크롤 설정 */
    }
    table {
        width: 100%; /* 테이블 너비를 100%로 설정 */
        border-collapse: collapse; /* 테이블 테두리 합병 설정 */
    }
    th {
        text-align: center;
        font-weight: bold;
        background-color: #f2f2f2;
    }
    td {
        text-align: center;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* 페이지네이션 */
    .pagination {
        text-align: center;
        list-style-type: none;
        padding: 0;
        margin: 20px auto; /* 페이지네이션과 테이블 사이 여백 */
        position: fixed; /* 페이지네이션 고정 */
        bottom: 0; /* 화면 하단에 위치 */
        left: 50%; /* 중앙 정렬을 위해 추가 */
        transform: translateX(-50%); /* 중앙 정렬 */
        background-color: #fff; /* 페이지네이션 배경색 설정 */
        z-index: 1000; /* 다른 요소 위에 표시되도록 설정 */
    }
    .pagination li {
        display: inline-block;
    }
    .h3 {
        font-size: 1.75rem;
        margin-top: 0;
        margin-bottom: .5rem;
        font-weight: 500;
        line-height: 1.2;
        text-align: left;
    }
    /* body */
    body {
        font-family: 'Noto Sans KR', sans-serif, 'Segoe UI Emoji', 'Noto Color Emoji', 'Segoe UI Symbol', 'Apple Color Emoji', 'EmojiSymbols', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        margin: 0; /* body의 기본 마진 제거 */
    }

    /*----------------------------------아래는 메뉴바---------------------------------*/
    /* 상단 메뉴바 */
    .menu {
    width: 100%;
    height: 50px;
    text-align: center;
    background-color: #212529;
    color: white;
    position: fixed;
    top: 0;
    left: 0; /* 왼쪽 끝에 고정 */
    z-index: 1000;
    border-bottom: none; /* 바로 밑에 있는 border 제거 */
    }

    .menu nav {
        width: 100%; /* 너비를 100%로 설정하여 전체 너비를 차지하도록 함 */
    }

    .menu nav ul {
        padding: 0;
        margin: 0;
        list-style-type: none;
        display: flex; /* 메뉴 항목을 수평으로 배치 */
        justify-content: flex-start; /* 왼쪽으로 정렬 */
    }

    .menu nav ul li {
        margin-right: 0px; /* 각 메뉴 항목 사이의 간격 설정 */
    }

    .menu nav ul li:last-child {
        margin-right: 0; /* 마지막 메뉴 항목의 간격은 없앰 */
    }

    .menu nav ul li a {
        line-height: 50px; /* 세로 중앙 정렬 */
        height: 50px;
        padding: 0 15px; /* 내부 여백 설정 */
        text-decoration: none;
        color: #888; /* 기본 회색 글씨 색상 */
        transition: color 0.3s ease; /* 색상 변화에 트랜지션 효과 추가 */
        font-size: 18px; /* 글씨 크기 설정 */
    }
    .menu nav ul li a.active {
        color: white; /* 선택된 메뉴 글씨색을 흰색으로 변경 */
        font-weight: bold; /* 선택된 메뉴 글씨를 볼드체로 변경 */
        /* 다른 스타일 추가 가능 */
}
    .menu nav ul li a:hover,
    .menu nav ul li a.active {
        color: white; /* 선택했을 때나 호버 시 흰색 글씨로 변경 */
    }

</style>
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
        </ul>
        <a id="pull" href="#"></a>
    </nav>
</div>

<?php 
// DB 관련
    global $db;
    $db = new mysqli("localhost", "root", "", "board"); 
    $db->set_charset("utf8");


    $posts_per_page = 10;
    $total_posts_query = "SELECT COUNT(*) as count FROM board";
    $total_posts_result = $db->query($total_posts_query);
    $total_posts_row = $total_posts_result->fetch_assoc();
    $total_posts = $total_posts_row['count'];
    $total_pages = ceil($total_posts / $posts_per_page);
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    if ($current_page > $total_pages) {
        $current_page = $total_pages;
    }

    if ($current_page < 1) {
        $current_page = 1;
    }

    $start_index = ($current_page - 1) * $posts_per_page;

    $sql = "SELECT * FROM board ORDER BY score DESC LIMIT $start_index, $posts_per_page"; 
    $result = $db->query($sql);

    // URL을 하이퍼링크로 변환하는 함수
    function make_links_clickable($text) {
        $pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
        return preg_replace($pattern, '<a href="$0" target="_blank">$0</a>', $text);
}

?>

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
        </ul>
        <a id="pull" href="#"></a>
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
            if ($result->num_rows > 0) {
                $rank = $start_index + 1;
                while($board = $result->fetch_assoc()) {
        ?>
            <tr>
                <td >
                    <?php
                        if ($rank == 1) echo "&#129351;";
                        else if ($rank == 2) echo "&#129352;";
                        else if ($rank == 3) echo "&#129353;";
                        else echo htmlspecialchars($rank); 
                    ?>
                </td>
                <td><?php echo htmlspecialchars($board['name']); ?></td>
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

<!-- Pagination -->
<div>
<?php
// 페이지네이션이 필요한 경우 표시
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