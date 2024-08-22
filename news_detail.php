<?php
$id = $_POST['id'];

// 別ファイルの読み込みに必要な処理　ここから↓
$count = substr_count($_SERVER['PHP_SELF'],'/');
$relation_path = '';
for($i=0; $i < ($count-2); $i++){
    $relation_path .= '../';
}

//ローカルのDB
//require_once dirname(__DIR__,$count). '/db_config/db_bord_de_mer.php';
//heurisのDB
require_once dirname(__DIR__,$count). '/v33/db_config/db_bord_de_mer.php';

// list.phpを読み込む
require_once $relation_path . 'inc/list.php';

try{
    $dbh = new PDO($dsn,$user,$pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM news WHERE id=?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1,$id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $dbh = null;
}catch(Exception $e){
    echo 'エラー発生：' . htmlspecialchars($e->getMessage(),ENT_QUOTES);
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://yarnpkg.com/en/package/normalize.css">
    <link href="dist/hamburgers.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Bord de mer HOTEL | restaurant</title>
</head>

<body>
    <div class="container">
        <header class="header-box">
            <h1 class="logo-img"><a href="#"><img class="logo" src="image/new-logo.png" alt="ロゴ"></a></h1>
            <nav class="nav">
                <div class="list">
                    <ul class="menu">
                        <li><a href="#">CONCEPT</a></li>
                        <li><a href="#">NEWS</a></li>
                        <li><a href="stay.html">STAY</a></li>
                        <li><a href="restaurant.html">RESTAURANT</a></li>
                        <li><a href="#">SERVICE</a></li>
                        <li><a href="#">ACCESS</a></li>
                        <li><a href="#">RESERVATION</a></li>
                        <li><a href="#">INQUIRY</a></li>
                    </ul>
                </div>
            </nav>
            
            <button class="navbtn hamburger hamburger--stand"
            onClick="document.querySelector('html').classList.toggle('open');
                    document.querySelector('.navbtn').classList.toggle('is-active');">
                <span class="hamburger-box"></span>
                    <span class="hamburger-inner"></span>
            </button>
        </header>

        <main class="page-main">
            <section>
                <h2>
                    <img class="pagetop-img" src="image/news.jpg" alt="#">
                </h2>
            </section>        
            <div class="articles-container">    
                <article>
                    <h3><?= htmlspecialchars($result['title'],ENT_QUOTES) ?></h3>
                        <p><span class="smallfont"><?= htmlspecialchars($result['open_date'],ENT_QUOTES) ?></span></p>
                        <p><?= nl2br(htmlspecialchars($result['comment'])) ?></p>
                </article>
                <div>
                    <input type="button" value="戻る" onClick="history.back()">
                </div>
            </div>
        </main>
        <footer class="footer">
            <div class="footer-container">
                <div class="sns-icon-container">
                    <a class="sns-icon" href="#"><img src="image/sns_icon/FB.png" alt="facebook"></a>
                    <a class="sns-icon" href="#"><img src="image/sns_icon/IG.png" alt="instagram"></a>
                    <a class="sns-icon" href="#"><img src="image/sns_icon/TW.png" alt="twitter"></a>
                </div>
            <p class="copyright"><small>&copy;Bord de mer HOTEL All Rights Reserved</small></p>
            </div>
        </footer>
    </div>
        

</body>
</html>