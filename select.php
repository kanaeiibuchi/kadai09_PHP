<?php
//1.  DB接続します
include("funcs.php");
$pdo =db_conn();

//２．データ登録SQL作成
$sql="SELECT * FROM gs_mogu_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$value="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONい値を渡す場合に使う
 $json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>メンバー一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}
td{border: 1px solid black;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
    <table>
      <?php foreach($values as $value){?>
      <tr>
      <td><?=h($value["id"])?></td>
      <td><?=h($value["name"])?></td>
      <td><?=h($value["email"])?></td>
      <td><?=h($value["place"])?></td>
      <td><?=h($value["comment"])?></td>
      <td><?=h($value["indate"])?></td>
      <td><a href="detail.php?id=<?=h($value["id"])?>">更新</a></td>
      <td><a href="delete.php?id=<?=h($value["id"])?>">削除</a></td>
      </tr>
        <?php } ?>
    </table>
</div></div>
<!-- Main[End] -->


<script>
  //JSON受け取り
  $a ='<?=$json?>';
const obj = JSON.parse($a);
console.log(obj);



</script>
</body>
</html>
