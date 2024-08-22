<?php
$in_date = $_POST['in_date'];
$out_date = $_POST['out_date'];
$number = (int)$_POST['number'];
$room_id= $_POST['room_id'];
$name = htmlspecialchars($_POST['name'],ENT_QUOTES);
$mail = htmlspecialchars($_POST['mail'],ENT_QUOTES);
$tel = htmlspecialchars($_POST['tel'],ENT_QUOTES);
$cxl = 0;

if($in_date==''||$out_date==''||$number==''||$room_id==''||$name==''||$mail==''||$tel==''){
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

// list.phpを読み込む
require_once $relation_path . 'inc/list.php';

try{
    $dbh = new PDO($dsn,$user,$pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //テーブルから以下の条件の予約を探す。
    //(部屋が同じ）かつ（inが、希望in日以前）かつ（outが、希望out日以降）かつ（CXL未）
    //該当する予約がいくつあるか調べる。
    $sql = 'SELECT * FROM reservation WHERE room_id=? AND out_date>? AND in_date<? AND cxl=0';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1,$room_id);
    $stmt->bindValue(2,$in_date);
    $stmt->bindValue(3,$out_date);
    $stmt->execute();

    $result = $stmt->rowCount();
    $dbh = null;
    //該当する予約が0なら予約を受けてDBに登録する。
    if ($result==0){
        $dbh = new PDO($dsn,$user,$pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO reservation (r_date,in_date,out_date,number,room_id,name,mail,tel,cxl) VALUES (now(),?,?,?,?,?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1,$in_date,PDO::PARAM_STR);
        $stmt->bindValue(2,$out_date,PDO::PARAM_STR);
        $stmt->bindValue(3,$number,PDO::PARAM_INT);
        $stmt->bindValue(4,$room_id,PDO::PARAM_INT);
        $stmt->bindValue(5,$name,PDO::PARAM_STR);
        $stmt->bindValue(6,$mail,PDO::PARAM_STR);
        $stmt->bindValue(7,$tel,PDO::PARAM_STR);
        $stmt->bindValue(8,$cxl,PDO::PARAM_INT);
        $stmt->execute();
        $dbh = null;
        $msg = 'ご予約ありがとうございました。ご予約内容は正常に送信されました。<br>';
        $msg .= '当日は、どうぞお気をつけてお越しくださいませ。';
        } else{

            $msg = '誠に申し訳ございませんが、ご指定の日付・日数ではご予約を承れません。<br>';
            $msg .= 'お手数をおかけいたしますが、日付を変更してお試しください。';
        }
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
    <!-- <meta http-equiv="refresh" content="8 ; URL=./"> -->
    <link rel="stylesheet" href="https://yarnpkg.com/en/package/normalize.css">
    <link href="dist/hamburgers.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">

    <title>Reservation -送信結果- | Bord de mer HOTEL</title>
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
            <section class="image-container">
            </section>
            <div class="reserve">
                <h2>ご予約フォーム送信結果</h2>
            </div>
            <p class="reserve-result"><?= $msg ?></p>
            <section class="rooms_btn">
                <div class="room_btn selected_btn">
                    <button type="button" onclick="history.back()">選び直す</a>
                </div>
                <div class="room_btn">
                    <a href="index.html">TOPへ戻る</a>
                </div>
            </section>
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
