<?php
$name = isset($_POST['name']) ? htmlspecialchars_decode($_POST['name'],ENT_QUOTES) : '';
$mail = isset($_POST['mail']) ? htmlspecialchars_decode($_POST['mail'],ENT_QUOTES) : '';
$kind = isset($_POST['kind']) ? (int)$_POST['kind'] : '';
$comment = isset($_POST['comment']) ? htmlspecialchars_decode($_POST['comment'],ENT_QUOTES) : '';

if($name=='' || $mail=='' || $kind=='' || $comment==''){
    header('location:error.php');
}

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

try{
    $dbh = new PDO($dsn,$user,$pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'INSERT INTO inquiry (name,mail,kind,comment) VALUES (?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1,$name,PDO::PARAM_STR);
    $stmt->bindValue(2,$mail,PDO::PARAM_STR);
    $stmt->bindValue(3,$kind,PDO::PARAM_INT);
    $stmt->bindValue(4,$comment,PDO::PARAM_STR);
    $stmt->execute();
    $dbh = null;
    $msg = 'お問い合わせありがとうございます。お問い合わせ内容は正常に送信されました。<br>';
    $msg .= '担当者が確認次第、返信させていただきます。<br>';
    $msg .= '今後とも当ホテルをよろしくお願いいたします。';

}catch(Exception $e){
    $msg = '送信ができませんでした。<br>もう一度やり直してください。';
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
    <main>
        <div>
            <h1>Inquiry -送信完了-</h1>
            <div>
                <p><?= $msg ?></p>
                <a href="index.html">TOPに戻る</a>
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