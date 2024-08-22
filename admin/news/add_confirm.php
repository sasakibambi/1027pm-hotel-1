<?php
session_start();
if(isset($_SESSION['login'])==false){
    header('location:login.php');
}


$now= new DateTime();
$now->format('Y-m-d');

// 別ファイルの読み込みに必要な処理　ここから↓
$count = substr_count($_SERVER['PHP_SELF'],'/');
$relation_path = '';//相対パス
//相対パスの../../を作る
for($i=0; $i < ($count-2); $i++){
    $relation_path .= '../';
}

// kind_arrayを読み込む
require_once $relation_path . 'inc/list.php';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>管理者ページ-お知らせ新規登録確認- | Bord de mer HOTEL</title>
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
        <h1 class="heading-decoration">管理者ページ <span>-お知らせ新規登録確認-</span></h1>
        <div class="entry-container contact">
            <form action="add_done.php" method="post">
                <ul>
                    <li>内容を確認し、「登録する」をクリックしてください。</li>
                </ul>
                <div class="form-content">
                    <div class="form-label">
                        <label for="title">タイトル</label>
                    </div>
                    <div><?= htmlspecialchars($_POST['title']) ?></div>
                    <input type="hidden" name="title" id="title" value="<?= $_POST['title'] ?>">
                </div>
                <div class="form-content">
                    <div class="form-label">
                        <label for="comment">内容</label>
                    </div>
                    <div><?= nl2br(htmlspecialchars($_POST['comment'])) ?></div>
                    <input type="hidden" name="comment" id="comment" value="<?= $_POST['comment'] ?>">
                </div>
                <div class="form-content">
                    <div class="form-label">
                        <label for="open_date">公開（予定）日</label>
                    </div>
                    <div><?= $_POST['open_date'] ?></div>
                    <input type="hidden" name="open_date" id="open_date" value="<?= $_POST['open_date'] ?>">    
                </div>
                <div class="form-content">
                    <div class="form-label">
                        <label for="open_date">公開設定</label>
                    </div>
                    <div><?= $article_status[$_POST['is_open']] ?></div>
                    <label><input type="hidden" name="is_open" value="<?= $_POST['is_open'] ?>"></label>
                </div>
            
                <div class="button-wrapper">
                    <input type="submit" value="登録する" class="btn btn-accent">
                    <input type="button" value="戻る" onClick="history.back()" class="btn">
                </div>
            </form>
        </div>
    </div>
</article>

<footer>

</footer>
</body>
</html>
