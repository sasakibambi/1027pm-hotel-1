<?php

$count = substr_count( $_SERVER['PHP_SELF'], '/');
$relation_path ='';
for( $i=0; $i < ($count-2) ; $i++){
    $relation_path .='../';
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="refresh" content="5 ; URL=./">
    <title>Error | Bord de mer HOTEL</title>
</head>
<body>
    <header class="header-box">
            <h1 class="logo-img"><a href="index.html"><img class="logo" src="image/new-logo.png" alt="ロゴ"></a></h1>
            <nav class="nav">
                <div class="list">
                    <nav class="nav">
                    <ul class="menu">
                        <li><a href="concept.html">CONCEPT</a></li>
                        <li><a href="news.html">NEWS</a></li>
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
    <main>
        <div>
            <h1>Error</h1>
            <div>
                <p>エラーが発生しました。</p>
                <a href="index.html" class="btn">TOPに戻る</a>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div>
        <img class="footer-img" src="image/footer2-2-01.jpg" alt="#">
        </div>
        <div>
        <p class="copyright"><small>&copy;Bord de mer HOTEL All Rights Reserved</small></p>
        </div>
    </footer>
</body>
</html>
