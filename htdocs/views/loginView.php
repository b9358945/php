<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>로그인</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
    <div class="container">
        <h2>로그인</h2>
        <form action="index.php?action=login" method="post">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <?php if (isset($error_message)): ?>
                <p style="color:red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <div>
                <button type="submit">로그인</button>
            </div>
        </form>
    </div>
</body>
</html>
