<?php
session_start();
if(isset($_SESSION['login'])==false){
    header('location:login.php');
}

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

try{
    $dbh = new PDO($dsn,$user,$pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM inquiry';
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
    <meta name="viewport" content="width=device-width">
    <title>管理者ページ-お問い合わせ一覧- | Bord de mer HOTEL</title>
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
            <h1 class="heading-decoration">管理者ページ <span>-お問い合わせ一覧-</span></h1>
            <div class="admin-container">
                <table class="list">
                    <tr>
                        <th>ID</th>
                        <th>お名前</th>
                        <th>操作</th>
                    </tr>
                    <?php foreach($result as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['name'],ENT_QUOTES) ?></td>
                            <td class="operation">
                                <form action="show.php" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="submit" value="詳細">
                                </form>
                                <form action="edit.php" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="submit" value="編集">
                                </form>
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="submit" value="削除">
                                </form>
                            </td>
                        </tr>      
                    <?php endforeach; ?>
                </table>
                <a href="../" class="btn">戻る</a>
            </div>
        </div>
    </article>
    <footer>

    </footer>
</body>
</html>
