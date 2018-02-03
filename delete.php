<?php
include("functions.php");

//データ受け取り
$id = $_GET["id"];

//1.  DB接続します
$pdo = db_con();
  
//２．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM photo WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  error_db_info($stmt);
}else{
  //５．index.phpへリダイレクト
  header("Location: manage.php");
  exit();
}

?>