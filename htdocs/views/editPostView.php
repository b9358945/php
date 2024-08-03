<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>글 수정</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
    <div class="container">
        <h2>글 수정</h2>
        <?php if ($post): ?>
        <form action="index.php?action=update_post" method="post" style="margin-bottom: 20px;">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($post['name']); ?>">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name_display" value="<?php echo htmlspecialchars($post['name']); ?>" readonly>
            </div>
            <div>
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" required><?php echo htmlspecialchars($post['comment']); ?></textarea>
            </div>
            <div>
                <button type="submit">수정하기</button>
            </div>
        </form>
        
        <!-- 삭제 버튼 -->
        <form action="index.php?action=delete_post" method="post" onsubmit="return confirm('정말로 삭제하시겠습니까?');">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($post['name']); ?>">
            <div>
                <button type="submit" style="background-color: red; color: white;">삭제하기</button>
            </div>
        </form>
        <?php else: ?>
        <p>해당 게시글을 찾을 수 없습니다.</p>
        <?php endif; ?>
    </div>
</body>
</html>
