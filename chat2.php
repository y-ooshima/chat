<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>
<body>

<h1>back-chat</h1>
 
<!-- action="chat.php" -->
<form method="post" >
    名前　　　　<input type="text" name="name"><br>
    メッセージ　<input type="text" name="message"><br>
 
    <button name="send" type="submit">送信</button><br>
    チャット履歴
</form>
<section>
    
<?php
require_once 'dbconnect.php';

    function insert() {
    $sql = "INSERT INTO message2 (name, message, time) VALUES (:name, :message, now())";

    $dbh = dbConnect();
    $dbh->beginTransaction();
        
    try{
    $stmt = $dbh->prepare($sql);
    // $stmt->bindValue(':id',$works['id'],PDO::PARAM_INT);
    $stmt->bindValue(':name',$_POST['name'],PDO::PARAM_STR);
    $stmt->bindValue(':message',$_POST['message'],PDO::PARAM_STR);
    //$stmt->bindValue(':time',$works['time'],PDO::PARAM_STR);
    $stmt->execute();
    $dbh->commit();

    }catch(PODException $e){
    $dbh->rollBack();
    exit($e);
    }
    }
    
    // 投稿内容を登録
    if(isset($_POST["send"])) {
    insert();
    }

    // DBから投稿内容を取得(最新の1件)
    function select_new() {
    $dbh = dbConnect();
    //$sql = "SELECT * FROM message ORDER BY time desc limit 1";
    $sql = "SELECT * FROM message2";
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
            <td><a class="btn btn-danger" href="/project/chat/delete2.php?time=<?php echo $colom['time'] ?>">削除</a></td>
        </tr>
    <?php endforeach; ?>
    </table>
    <a href="chat.php">戻る</a>
</body>
</html>