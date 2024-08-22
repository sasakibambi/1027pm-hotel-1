<?php
session_start();
if(isset($_SESSION['msg'])==false){
    $_SESSION['msg'] = '';
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>管理者ページ | Bord de mer HOTEL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@400;700&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/adminstyle.css">
</head>
<body>
    <header>

    </header>
    <article class="admin">
        <div class="w-container">
            <h1 class="heading-decoration">ログイン</h1>
            <div class="entry-container contact">
                <form action="check_user.php" method="post">
                    <p class="err-msg">
                        <?php
                            echo $_SESSION['msg'];
                            $_SESSION['msg'] = '';
                        ?>
                    </p>
                    <div class="form-content">
                        <div class="form-label">
                            <label for="mail">メールアドレス</label>
                        </div>
                        <input type="email" name="mail" id="mail" required>
                    </div>
                    <div class="form-content">
                        <div class="form-label">
                            <label for="password">パスワード</label>
                        </div>
                        <div class="field-password">
                            <input type="password" name="password" id="password" required>
                            <i id="btn-eye" class="fas fa-eye"></i>
                        </div>
                    </div>
                    <div class="button-wrapper">
                        <input type="submit" value="ログイン" class="btn btn-accent">
                        <input type="reset" value="リセット" class="btn">
                    </div>
                </form>
            </div>
        </div>
    </article>
    <footer>

    </footer>
    <script src="<?= $relation_path ?>/js/app.js"></script>
</body>
</html>
