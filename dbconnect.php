<?php
ini_set('display_errors', true);

function dbConnect(){
    $dsn = 'mysql:dbname=chat; host=127.0.0.1; charset=utf8';
    $user = 'selfusr';
    $pass = 'chatpass';
    // 1.データベースに接続する。
    try{
        $dbh = new PDO($dsn,$user,$pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            //echo '接続完了';
            return $dbh;
            //$pdo = null;
        }catch(PODException $e){
            echo '接続失敗'.$e->getMessage();
            exit();
        }
        //return $dbh;
}
?>