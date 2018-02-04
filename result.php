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
$sql = "select score from player where id=$id";
$sth = $dbh->prepare($sql); 
$sth->execute();  //実行
$myresult=$sth->fetch(PDO::FETCH_ASSOC)['score'];

$sql = "select score from player where id=$targetid";
$sth = $dbh->prepare($sql); 
$sth->execute();  //実行
$otherresult=$sth->fetch(PDO::FETCH_ASSOC)['score'];
$result=[$myresult,$otherresult];


header('Access-Control-Allow-Origin: *');

echo json_encode($result);
