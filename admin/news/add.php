<?php
session_start();
if(isset($_SESSION['login'])==false){
    header('location:login.php');
}

$now= new DateTime();
$now->format('Y/n/d');


// 別ファイルの読み込みに必要な処理　ここから↓
$count = substr_count($_SERVER['PHP_SELF'],'/');
$relation_path = '';//相対パス
//相対パスの../../を作る
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
    <meta name="viewport" content="width=device-width">
    <title>管理者ページ-お知らせ一覧- | Bord de mer HOTEL</title>
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
        <h1 class="heading-decoration">管理者ページ <span>-お知らせ新規登録-</span></h1>
        <div class="entry-container contact">
            <form action="add_confirm.php" method="post">
                <ul>
                    <li>必要事項を記入し、「確認する」をクリックしてください。</li>
                </ul>
                <div class="form-content">
                    <div class="form-label">
                        <label for="title">タイトル</label>
                        <span class="required">必須入力</span>
                    </div>
                    <input type="text" name="title" id="title" required>
                </div>
                <div class="form-content">
                    <div class="form-label">
                        <label for="comment">内容</label>
                        <span class="required">必須入力</span>
                    </div>
                    <textarea name="comment" id="comment" required></textarea>
                </div>
                <div class="form-content">
                    <div class="form-label">
                        <label for="open_date">公開（予定）日</label>
                        <span class="required">必須入力</span>
                    </div>
                    <input type="date" name="open_date" id="open_date" value="<?= $new ?>" required>    
                </div>
                <div class="form-content">
                    <div class="form-label">
                        <label for="open_date">公開設定</label>
                    </div>
                    <?php foreach($article_status as $key => $value): ?>
                    <label><input type="radio" name="is_open" value="<?=$key ?>" <?php if($key==1) echo 'checked'; ?> ><?= $value ?></label>
                    <?php endforeach; ?>
                </div>
            
                <div class="button-wrapper">
                    <input type="submit" value="確認する" class="btn btn-accent">
                    <a href="./" class="btn">戻る</a>
                </div>
            </form>
        </div>
    </div>
</article>
<footer>

</footer>
</body>
</html>
