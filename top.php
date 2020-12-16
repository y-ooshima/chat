<?php
session_start();

require_once 'Userlogic.php';

session_start();

//エラーメッセージ
$err = [];

if(!$email = filter_input(INPUT_POST, 'email')){
    $err['email'] = 'メールアドレスを記入してください';
}
if(!$password = filter_input(INPUT_POST, 'password')){
    $err['password'] = 'パスワードを記入してください';
}

if(count($err) > 0) {
    //エラーが会ったら画面を戻す
    $_SESSION = $err;
    header('Location: login.php');
    return;
}
$result = Userlogic::login($email, $password);

if(!$result){
    //ログイン失敗時
    header('Location: login.php');
    return;
}
echo '裏チャット';

header("location: chat2.php");

?>
    <a href="chat.php">戻る</a>