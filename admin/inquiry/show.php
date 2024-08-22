<?php
session_start();
if(isset($_SESSION['login'])==false){
    header('location:login.php');
}

$id = (int)$_POST['id'];

// 別ファイルの読み込みに必要な処理　ここから↓
$count = substr_count($_SERVER['PHP_SELF'],'/');
$relation_path = '';//相対パス
//相対パスの../../を作る
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
    $sql = 'SELECT * FROM inquiry WHERE id = ?';
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
    <meta name="viewport" content="width=device-width">
    <title>管理者ページ-お問い合わせ詳細- | Bord de mer HOTEL</title>
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
        <!-- <figure class="entry-img">
            <img src="../../img/service.jpg" alt="" width="1600" height="470">
        </figure> -->
        <div class="w-container">
            <h1 class="heading-decoration">管理者機能 <span>-お問い合わせ詳細-</span></h1>
            <div class="admin-container">
                <table class="show">
                    <tr>
                        <th>ID</th>
                        <td><?= $result['id'] ?></td>
                    </tr>
                    <tr>
                        <th>お名前</th>
                        <td><?= htmlspecialchars($result['name'],ENT_QUOTES) ?></td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td><?= htmlspecialchars($result['mail'],ENT_QUOTES) ?></td>
                    </tr>
                    <tr>
                        <th>お問い合わせの種類</th>
                        <td><?= $kind_array[$result['kind']] ?></td>
                    </tr>
                    <tr>
                        <th>お問い合わせ内容</th>
                        <td><?= nl2br(htmlspecialchars($result['comment'],ENT_QUOTES)) ?></td>
                    </tr>
                </table>
                <a href="./" class="btn">戻る</a>
            </div>
        </div>
    </article>
    <footer>

    </footer>
</body>
</html>
