<?php
session_start();
if(isset($_SESSION['login'])==false){
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>管理者ページ | Bord de mer HOTEL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@400;700&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/adminstyle.css">
</head>
<body>
    <header>

    </header>
    <article class="admin">
        <div class="w-container">
            <h1 class="heading-decoration">管理者ページ</h1>
            <p></p>
            <div class="admin-container">
                <ul class="icon-btn-container">
                <li class="icon-btn">
                        <a href="./news/">
                        <i class="far fa-edit"></i>
                            お知らせ管理
                        </a>
                    </li>
                    <li class="icon-btn">
                        <a href="./reservation/">
                        <i class="fas fa-file-import"></i>
                            予約状況
                        </a>
                    </li>
                    <li class="icon-btn">
                        <a href="./inquiry/">
                            <i class="far fa-envelope"></i>
                            お問い合わせ
                        </a>
                    </li>
                </ul>
                <a href="logout.php" class="btn">ログアウト</a>
            </div>
        </div>
    </article>
    <footer>
        
    </footer>
</body>
</html>

