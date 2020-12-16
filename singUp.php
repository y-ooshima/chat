<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="singupstyle.css">
  <title>ユーザー登録画面</title>
</head>
<body>
<div class="form-wrapper">
  <h2>ユーザー登録フォーム</h2>
  <form action="register.php" method='POST'>

    <div class="form-item">
      <label for="email">メールアドレス：</label>
      <input type="email" name = "email" required="required" placeholder="Email Address">
      </div>
    <div class="form-item">
      <label for="password">パスワード：</label>
      <input type="password" name = "password" required="required" placeholder="Password">
    </div>
    <!-- <p>
      <label for="password_conf">パスワード確認：</label>
      <input type="password" name = "password_conf">
    </p> -->
    <p>
      <input class="btn btn-outline-info" type="submit" value="新規登録">
    </p>
    <a class="btn btn-outline-dark" href="login.php">ログイン画面へ</a>
  </form>
  </div>
</body>
</html>