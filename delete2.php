<?php

$time = $_GET['time'];
//echo $time;

// if(empty($name)) {
//     exit('nameが不正です');
// }

require_once 'dbconnect.php';

$pdo = dbConnect();

// SQL文を作成
$sql = "DELETE FROM message2 WHERE time = '{$time}'";

// クエリ実行（データを取得）
$res = $pdo->query($sql);
//var_dump($res);
print '削除完了';
?>

<p><a href="/project/chat/chat2.php">入力画面に戻る</a></p>