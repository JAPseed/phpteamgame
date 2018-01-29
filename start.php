<?php

$dsn  = 'mysql:dbname=slot;host=127.0.0.1';   //接続先
$user = 'root';         //MySQLのユーザーID
$pw   = 'H@chiouji1';   //MySQLのパスワード
//ユーザー追加

$dbh = new PDO($dsn, $user, $pw);   //接続


//ユーザー番号の返却
$sql = 'select max(id) from player';
$sth = $dbh->prepare($sql); 
$sth->execute();  //実行
$result=$sth->fetch(PDO::FETCH_ASSOC);

header('Access-Control-Allow-Origin: *');

echo json_encode($result['max(id)']);
