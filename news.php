<?php

// 別ファイルの読み込みに必要な処理　ここから↓
$count = substr_count($_SERVER['PHP_SELF'],'/');
$relation_path = '';
for($i=0; $i < ($count-2); $i++){
    $relation_path .= '../';
}
//ローカルのDB
// require_once dirname(__DIR__,$count). '/db_config/db_bord_de_mer.php';
//heurisのDB
require_once dirname(__DIR__,$count). '/v33/db_config/db_bord_de_mer.php';

// list.phpを読み込む
require_once $relation_path . 'inc/list.php';

try{
    $dbh = new PDO($dsn,$user,$pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM news WHERE open_date <= now() AND is_open =1 ORDER BY open_date DESC';
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://yarnpkg.com/en/package/normalize.css">
    <link href="dist/hamburgers.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Bord de mer HOTEL | News</title>
</head>

<body>
    <div class="container">
    <header class="header-box">
            <h1 class="logo-img"><a href="index.html"><img class="logo" src="image/new-logo.png" alt="ロゴ"></a></h1>
            <nav class="nav">
                <div class="list">
                    <nav class="nav">
                    <ul class="menu">
                        <li><a href="concept.html">CONCEPT</a></li>
                        <li><a href="news.php">NEWS</a></li>
                        <li><a href="stay.html">STAY</a></li>
                        <li><a href="restaurant.html">RESTAURANT</a></li>
                        <li><a href="access.html">ACCESS</a></li>
                        <li><a href="reservation.html">RESERVATION</a></li>
                        <li><a href="inquiry.html">INQUIRY</a></li>
                    </ul>
                    </nav>
                </div>
            </nav>

            <!-- ハンバーガーメニュー -->
                    <button class="navbtn"
            onClick="document.querySelector('html').classList.toggle('open')">
                <i class="fas fa-bars"></i>
                <i class="fas fa-times"></i>
                <span class="sr-only">Menu</span>
            </button>
        </header>

        <main class="page-main">
            <section>
                <h2> 
                    <img class="pagetop-img" src="image/news.jpg" alt="#">
                </h2>
            </section>
            <div class="articles-container">

            <?php foreach($result as $row): ?>
                <article class="article">
                        <div class="article-txt-box">                       
                            <h3 class="title"> <?= htmlspecialchars($row['title']) ?></h3>
                            <span class="smallfont"><time class="open_date" datetime="<?= $row['open_date'] ?>>"><?= $row['open_date'] ?></time></span>
                            <form action="news_detail.php" method="post">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="submit" value="詳しく見る">
                            </form>
                        </div>
                        
                </article>
                <?php endforeach;?>
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