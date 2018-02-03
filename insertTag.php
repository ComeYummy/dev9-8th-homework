<?php
$title = $_GET["title"];
//フォームのデータ受け取り
$tag = $_POST ['tag'];
$id = $_POST ['dataId'];
var_dump("title: ".$title);
var_dump("id: ".$id);


//PDOでデータベース接続
try {
    $pdo = new PDO("mysql:host=localhost;dbname=photoBucket_db;charset=utf8","root",""); 
    //XAMPPは最後(password)のrootはいらない。MAMPはいる。
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());
}

var_dump($tag);

// 実行したいSQL文
$sql = "UPDATE photo SET tag01=:tag01 WHERE id=:id"; 

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':tag01', $tag, PDO::PARAM_STR); 
$stmt->bindValue(':id', $id, PDO::PARAM_INT); 

//実際に実行
$flag = $stmt->execute();
//$flagに成功失敗のbool値が入る。

//失敗した場合はエラーメッセージ表示
if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
    $url = 'index2.php?title='.$title;
    var_dump($url);
    header ('Location: index2.php?title='.$title);
    exit();
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PHOTO BUCKET</title>

    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>

<!-- localstrageの値を引き渡すためだけにform作成 -->
<form action="index2.php" method="post" name="titleSubmit">
    <input type="text" id="title" class="title-field" name="titleFrom1" style="display:none">
</form>

<script>
$("#title").val(localStorage.getItem("title"));
// form送信して画面遷移
// document.titleSubmit.submit();


</script>

</body>

</html>