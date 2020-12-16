<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="chatstyle.css">
    <title>Chat</title>
</head>
<body>
<div class="alert alert-success" role="alert">

<h3>Chat-room</h3>
 
<!-- action="chat.php" -->
<form method="post" >
<div class="form-group">
    <label for="formGroupExampleInput">name</label>
    <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Example input">
  </div>
<!-- <input type="text" name="name"><br> -->
<div class="form-group">
    <label for="formGroupExampleInput2">message</label>
    <input type="text" name="message" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
  </div>
<!-- <input type="text" name="message"><br> -->
 
    <button name="send" class="btn btn-secondary btn-lg btn-block" type="submit">送信</button><br>
</form>
</div>
<section>
    
<?php
require_once 'dbconnect.php';
    
    function insert() {
    $sql = "INSERT INTO message (name, message, time) VALUES (:name, :message, now())";

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
    $sql = "SELECT * FROM message";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
    }
    //取得したデータ
    $blogDate = select_new();

?>
</section>
<div class="alert alert-warning" role="alert">
<h3>Chat-history</h3>
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
            <?php if($colom['message'] == '裏') : ?>
            <td><a href="/project/chat/login.php">裏</a></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </table>
</div>
</body>
</html>