<?php
session_start();
if(isset($_SESSION['login'])==false){
    header('location:login.php');
}

$id = $_POST['id'];

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
    $sql = 'SELECT * FROM reservation JOIN rooms ON reservation.room_id=rooms.id WHERE reservation.id=?';
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
    <title>管理者ページ-予約詳細- | Bord de mer HOTEL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@400;700&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/adminstyle.css">
</head>
<body>
    <article class="admin">
        <div class="w-container">
            <h1 class="heading-decoration">管理者ページ <span>-予約詳細-</span></h1>
            <div class="admin-container">
                <table class="show">
                    <tr>
                        <th>予約番号</th>
                        <td><?= $result['id'] ?></td>
                    </tr>
                    <tr>
                        <th>予約状況</th>
                        <td><?=$cxl_array[$result['cxl']] ?></td>
                    </tr>
                    <tr>
                        <th>チェックイン日</th>
                        <td><?= htmlspecialchars($result['in_date'],ENT_QUOTES) ?></td>
                    </tr>
                    <tr>
                        <th>チェックアウト日</th>
                        <td><?= htmlspecialchars($result['out_date'],ENT_QUOTES) ?></td>
                    </tr>
                    <tr>
                        <th>人数</th>
                        <td><?=$result['number'] ?></td>
                    </tr>
                    <tr>
                        <th>部屋</th>
                        <td><?= htmlspecialchars($result['room_name'],ENT_QUOTES) ?></td>
                    </tr>
                    <tr>
                        <th>お名前</th>
                        <td><?= htmlspecialchars($result['name'],ENT_QUOTES)?></td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td><?= htmlspecialchars($result['mail'],ENT_QUOTES) ?></td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td><?= htmlspecialchars($result['tel'],ENT_QUOTES) ?></td>
                    </tr>
                    <tr>
                        <th>宿泊料金</th>
                        <td><?php echo number_format($result['rate_person'] * $result['number']); ?>円 </td>
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