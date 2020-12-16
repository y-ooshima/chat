<?php
session_start();
$err = $_SESSION;
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>ログイン画面</title>
</head>
<body>
<div class="form">
  <h2>ログインフォーム</h2>
  <?php if(isset($err['msg'])) : ?>
      <p><?php echo $err['msg']; ?></p>
      <?php endif; ?>

    <form action="top.php" method='POST'>
    <div class="text-input">
      <label for="email">メールアドレス：</label>
      <input type="email" name = "email" id="username">
      <span class="separator"> </span>
      <?php if(isset($err['email'])) : ?>
      <p><?php echo $err['email']; ?></p>
      <?php endif; ?>
    </div> 
    <div class="text-input">
      <label for="password">パスワード：</label>
      <input type="password" name = "password" id="password">
      <span class="separator"> </span>
      <?php if(isset($err['password'])): ?>
      <p><?php echo $err['password']; ?></p>
      <?php endif; ?>
    </div>
      
    <div class="form-bottom">
      <input class="btn btn-secondary btn-lg btn-block" type="submit" id="submit" value="ログイン">
      <a class="btn btn-primary btn-lg btn-block" href="singUp.php">新規登録</a>
    </div>
  </form>
    </div>
  
</body>
</html>