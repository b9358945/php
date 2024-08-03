<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
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
        </nav>
    </div>
    <div class="container">
        <h2>회원가입</h2>
        <form action="index.php?action=register" method="post">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit">회원가입</button>
            </div>
        </form>
    </div>
</body>
</html>
