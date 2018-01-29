<?php

$dsn  = 'mysql:dbname=slot;host=127.0.0.1';   //接続先
$user = 'root';         //MySQLのユーザーID
$pw   = 'H@chiouji1';   //MySQLのパスワード

$id = $_GET['id'];//誰か

$dbh = new PDO($dsn, $user, $pw);   //接続

$targetid=$id;
if($id%2==0){
	$targetid=$targetid-1;
}
else{
	$targetid=$targetid+1;
}
//ユーザー番号の返却
$sql = "select uppiece,centerpiece,downpiece,score from player where id=$targetid";
$sth = $dbh->prepare($sql); 
$sth->execute();  //実行
$result=$sth->fetch(PDO::FETCH_ASSOC);


header('Access-Control-Allow-Origin: *');

echo json_encode($result);
