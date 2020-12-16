<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>
<body>

<h1>合同チャット</h1>   
<?php
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

    // DBから投稿内容を取得(最新の1件)
    function select_new() {
    $dbh = dbConnect();
    //$sql = "SELECT * FROM message ORDER BY time desc limit 1";
    //SELECT tb1.member_name, tb2.group_name FROM DB1.table1 AS tb1, DB2.table2 AS tb2 INNER JOIN tb2 ON tb1.id = tb2.id
    //$sql = "SELECT * FROM message";
    $sql = "SELECT message.message, 
    GROUP_CONCAT (message2.message) AS message2 FROM message,message2 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
    }
    //取得したデータ
    $blogDate = select_new();

?>
</section>
    <table>
    <tr>
        <!-- <th>時間</th>
        <th>名前</th>
        <th>メッセージ</th> -->
    </tr>
    <?php foreach($blogDate as $colom): ?>
        <tr>
            <th><?php echo $colom['name'] ?> : </th>
            <th><?php echo $colom['message'] ?></th>
            <th>[<?php echo $colom['time'] ?>]</th>
            <td><a href="/project/chat/delete.php?time=<?php echo $colom['time'] ?>">削除</a></td>
        </tr>
    <?php endforeach; ?>
    </table>
</body>
</html>