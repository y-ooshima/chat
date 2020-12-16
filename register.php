<?php

require_once 'Userlogic.php';

//エラーメッセージ
$err = [];

// if(!$username = filter_input(INPUT_POST, 'username')){
//     $err[] = 'ユーザー名を記入してください';
// }
if(!$email = filter_input(INPUT_POST, 'email')){
    $err[] = 'メールアドレスを記入してください';
}
$password = filter_input(INPUT_POST, 'password');
//正規表現
if(!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)) {
    $err[] = 'パスワードは英数字8文字以上にしてください';
}
// $password_conf = filter_input(INPUT_POST, 'password_conf');
//     $err[] = 'パスワードは英数字8文字以上にしてください';

if(count($err) === 0) {
    //ユーザーを登録する処理
    $hasCreated = Userlogic::createUser($_POST);
    if(!$hasCreated){
        $err[] ='登録に失敗しました';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録完了画面</title>
</head>
<body>
    <?php if (count($err) > 0) :?>
        <?php foreach($err as $e) :?>
        <p><?php echo $e ?></p>
        <?php endforeach ?>
    <?php else :?>
        <p>ユーザー登録が完了しました。</p>
    <?php endif?>
    <a href="./singUp.php">戻る</a>
</body>
</html>