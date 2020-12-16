<?php

require_once 'dbconnect.php';

//$db = dbConnect();

class Userlogic
{
    public static function createUser($userData)
    {
        $result = false;
        $sql = 'INSERT INTO userDeta (email,password) VALUES (?,?)';
        //ユーザーデータを配列にいれる
        $arr = [];
        $arr[] = $userData['email'];//email
        $arr[] = password_hash($userData['password'],PASSWORD_DEFAULT);//password
        try{
            $stmt = dbConnect()->prepare($sql);
            $result = $stmt->execute($arr);
            return $result;
            
        }catch(\Exception $e){
            return $result;

        }
    }
    public static function login($email,$password){
        //結果
        $result = false;
        $user = self::getUserByEmail($email);

        if(!$user){
            $_SESSION['msg'] = 'emailが一致しません';
            return $result;
        }

      if(password_verify($password, $user['password'])){
          //ログイン成功
          session_regenerate_id(true);
          $_SESSION['login_user'] = $user;
          $result = true;
          return $result;
      }
        $_SESSION['msg'] = 'パスワードが一致しません';
        return $result;
    }
    public static function getUserByEmail($email){
        //sqlの準備
        //sqlの実行
        //sqlの結果を返す
            $sql = 'SELECT * FROM userDeta WHERE email = ?';
            //ユーザーデータを配列にいれる
            $arr = [];
            $arr[] = $email;//email
            try{
                $stmt = dbConnect()->prepare($sql);
                $stmt->execute($arr);
                //sqlの結果を返す
                $user = $stmt->fetch();
                return $user;

            }catch(\Exception $e){
                return false;
            }
    }
    
}

?>