<?php
//共通に使う関数を記述
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}
//DBConnection
function db_conn(){
    try {
        //Password:MAMP='root',XAMPP=''
      return new PDO('mysql:dbname=gu_db;charset=utf8;host=localhost','root','');
    
      } catch (PDOException $e) {
        exit('DB_CONECT:'.$e->getMessage());
      }
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){   
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}

?>