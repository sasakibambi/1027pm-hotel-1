<?php 
session_start();
if(isset($_SESSION['msg'])==false){
    $_SESSION['msg'] = '';
}

$mail = htmlspecialchars($_POST['mail'],ENT_QUOTES);
$password = htmlspecialchars($_POST['password'],ENT_QUOTES);

$count = substr_count($_SERVER['PHP_SELF'],'/');
$relation_path = '';
for($i=0; $i < ($count-2); $i++){
    $relation_path .= '../';
}

if($mail == 'admin@test.co.jp' && $password == 'adminpass'){
    $_SESSION['login'] = session_id();
    header('location:index.php');
}else{
    $_SESSION['msg'] = '※メールアドレスまたはパスワードが一致しません。';
    header('location:login.php');
}