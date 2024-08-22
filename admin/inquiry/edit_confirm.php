<?php
session_start();
if(isset($_SESSION['login'])==false){
    header('location:login.php');
}

$id = (int)$_POST['id'];
$name = htmlspecialchars($_POST['name'],ENT_QUOTES);
$mail = htmlspecialchars($_POST['mail'],ENT_QUOTES);
$kind = $_POST['kind'];
$comment = htmlspecialchars($_POST['comment'],ENT_QUOTES);

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
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>管理者ページ-お問い合わせ編集確認- | Bord de mer HOTEL</title>
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
            <h1 class="heading-decoration">管理者ページ <span>-お問い合わせ編集確認-</span></h1>
            <div class="entry-container contact">
                <form action="edit_done.php" method="post">
                    <ul>
                        <li>内容を確認し、変更する場合は「変更する」をクリックしてください。</li>
                    </ul>
                    <div class="form-content">
                        <div class="form-label">お名前</div>
                        <?= $name ?>
                        <input type="hidden" name="name" value="<?= $name ?>">
                    </div>
                    <div class="form-content">
                        <div class="form-label">メールアドレス</div>
                        <?= $mail ?>
                        <input type="hidden" name="mail" value="<?= $mail ?>">
                    </div>
                    <div class="form-content">
                        <div class="form-label">お問い合わせの種類</div>
                        <?= $kind_array[$kind] ?>
                        <input type="hidden" name="kind" value="<?= $kind ?>">
                    </div>
                    <div class="form-content">
                        <div class="form-label">お問い合わせ内容</div>
                        <?= nl2br($comment) ?>
                        <input type="hidden" name="comment" value="<?= $comment ?>">
                    </div>
                    <div class="button-wrapper">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <input type="submit" class="btn btn-accent" value="変更する">
                        <input type="button" class="btn" value="戻る" onClick="history.back()">
                    </div>
                </form>
            </div>
        </div>
    </article>
    <footer>

    </footer>
</body>
</html>
