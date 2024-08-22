<?php
session_start();
if(isset($_SESSION['login'])==false){
    header('location:login.php');
}

$title = isset($_POST['title']) ? htmlspecialchars_decode($_POST['title'],ENT_QUOTES) : '';
$comment = isset($_POST['comment']) ? htmlspecialchars_decode($_POST['comment'],ENT_QUOTES) : '';
$is_open = isset($_POST['is_open']) ? (int)$_POST['is_open'] : '';
$open_date = isset($_POST['open_date']) ? $_POST['open_date'] : '';



// //$name、$mail、$kind、$commentの値がひとつでも空だったらエラーページに飛ばす
// if($name=='' || $mail=='' || $kind=='' || $comment==''){
//     header('<location: ./');
// }

$now= new DateTime();
$now->format('Y-m-d');


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

// kind_arrayを読み込む
require_once $relation_path . 'inc/list.php';

try{
    $dbh = new PDO($dsn,$user,$pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'INSERT INTO news(reg_date,open_date,title,comment,is_open) VALUES (now(),?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1,$open_date,PDO::PARAM_STR);
    $stmt->bindValue(2,$title,PDO::PARAM_STR);
    $stmt->bindValue(3,$comment,PDO::PARAM_STR);
    $stmt->bindValue(4,$is_open,PDO::PARAM_INT);
    $stmt->execute();
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
    <meta name="viewport" content="width=device-width">
    <title>管理者ページ-お知らせ新規登録完了- | Bord de mer HOTEL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@400;700&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/adminstyle.css">
</head>
<body>
    <header>

    </header>
    <article class="admin">
        <div class="w-container">
            <h1 class="heading-decoration">管理者ページ <span>-お知らせ新規登録完了-</span></h1>
            <p>Admin</p>
            <div class="entry-container contact">
                <p>
                    お知らせの新規登録が完了しました。
                </p>
                <a href="./" class="btn">戻る</a>
            </div>
        </div>
    </article>
    <footer>

    </footer>
</body>
</html>
