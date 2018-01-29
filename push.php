<?php

$dsn  = 'mysql:dbname=slot;host=127.0.0.1';   //接続先
$user = 'root';         //MySQLのユーザーID
$pw   = 'H@chiouji1';   //MySQLのパスワード

$id = $_GET['id'];//誰か
$type=$_GET['type'];//どの絵か
$target=$_GET['target'];//上中下のどれか

$dbh = new PDO($dsn, $user, $pw);   //接続

//ユーザー番号の返却
$sql = "select uppiece,centerpiece,downpiece,score from player where id=$id";
$sth = $dbh->prepare($sql); 
$sth->execute();  //実行
$result=$sth->fetch(PDO::FETCH_ASSOC);
$up=$result['uppiece'];
$center=$result['centerpiece'];
$down=$result['downpiece'];

$score=100;
$score=$result['score'];

if($target=='uppiece'){
	$up=$type;
}
else if($target=='centerpiece'){
	$center=$type;
}
else if($target =='downpiece'){
	$down=$type;
}

if($up==$center&&$up==$down){
	$score+=100;
}
//ユーザー追加
//$sql = 'update player set '+$target+'='+$type+',score='+$score' where id='+$id;
$sql = "update player set $target=$type,score=$score where id=$id";


$sth = $dbh->prepare($sql);         //SQL準備

$sth->execute();  //実行


header('Access-Control-Allow-Origin: *');

echo json_encode($score);
