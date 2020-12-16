<?php

$time = $_GET['time'];
echo $time;

// if(empty($name)) {
//     exit('nameが不正です');
// }

function dbConnect(){
    $dsn = 'mysql:dbname=chat; host=127.0.0.1; charset=utf8';
    $user = 'selfusr';
    $pass = 'chatpass';
    // 1.データベースに接続する。
    try{
        $dbh = new PDO($dsn,$user,$pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            //echo '接続完了';
        }catch(PODException $e){
            echo '接続失敗'.$e->getMessage();
            exit();
        }
        return $dbh;
}

$pdo = dbConnect();

// SQL文を作成
$sql = "DELETE FROM message WHERE time = '{$time}'";

// クエリ実行（データを取得）
$res = $pdo->query($sql);

header("location: chat.php");

?>

<p><a href="/project/chat/chat.php">入力画面に戻る</a></p>