<?php
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name'],ENT_QUOTES) : '';
$mail = isset($_POST['mail']) ? htmlspecialchars($_POST['mail'],ENT_QUOTES) : '';
$kind = isset($_POST['kind']) ? $_POST['kind'] : '';
$comment = isset($_POST['comment']) ? htmlspecialchars($_POST['comment'],ENT_QUOTES) : '';
//$name、$mail、$kind、$commentの値がひとつでも空だったらエラーページに飛ばす
if($name=='' || $mail=='' || $kind=='' || $comment==''){
    header('location:error.php');
}

// 別ファイルの読み込みに必要な処理　ここから↓
$count = substr_count($_SERVER['PHP_SELF'],'/');
$relation_path = '';//相対パス
for($i=0; $i < ($count-2); $i++){
    $relation_path .= '../';
}
// list.phpを読み込む
require_once $relation_path . 'inc/list.php';
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
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Bord de mer HOTEL | Inquiry</title>
</head>

<body>
    <div class="container">
        <header class="header-box">
            <div class="logo-img"><a href="index.html"><img class="logo" src="image/new-logo.png" alt="ロゴ"></a></div>
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
        <section class="image-container" id="inquiry-top">
            <h2> 
                <!-- <p class="text1">Bord de Mer</p>
                <p class="text2">海辺の隠れ家で極上のリゾート体験を</p> -->
                <img class="pagetop-img" src="image/inquiry.jpg" alt="#">
            </h2>
        </section>
        <div class="text-container">
            <h2>ご入力内容確認</h2>   
            <p>以下の項目にご入力の上、確認ボタンを押してください。</p>
        </div>
        <div class="text-container">
            <form action="done.php" method="post">
                <div class="form-content">
                    <div class="form-label">お名前</div>
                    <div id="font-change-to-def"><?= htmlspecialchars($name,ENT_QUOTES) ?></div>
                    <input type="hidden" name="name" value="<?= htmlspecialchars($name,ENT_QUOTES) ?>">
                </div>
                <div class="form-content">
                    <div class="form-label">メールアドレス</div>
                    <div id="font-change-to-def"><?= htmlspecialchars($mail,ENT_QUOTES) ?></div>
                    <input type="hidden" name="mail" value="<?= htmlspecialchars($mail,ENT_QUOTES) ?>">
                </div>
                <div class="form-content">
                    <div class="form-label">お問い合わせの種類</div>
                    <div id="font-change-to-def"><?= $kind_array[$kind] ?></div>
                    <input type="hidden" name="kind" value="<?= $kind ?>">
                </div>
                <div class="form-content">
                    <div class="form-label">お問い合わせ内容</div>
                    <div id="font-change-to-def"><?= nl2br(htmlspecialchars($comment,ENT_QUOTES)) ?></div>
                    <input type="hidden" name="comment" value="<?= nl2br(htmlspecialchars($comment,ENT_QUOTES)) ?>">
                </div>
                <div>
                    <input type="submit" value="送信する">
                    <input type="button" value="戻る" onClick="history.back()">
                </div>
            </form>
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
</body>
</html>
