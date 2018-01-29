<?php

$dsn  = 'mysql:dbname=slot;host=127.0.0.1';   //接続先
$user = 'root';         //MySQLのユーザーID
$pw   = 'H@chiouji1';   //MySQLのパスワード
//ユーザー追加
$sql = 'INSERT INTO player(uppiece,centerpiece,downpiece,score) VALUES(0,0,0,0)';//VALUES(?,?)は、executeの引数の配列より、左から順番に?の部分と置き換わる

$dbh = new PDO($dsn, $user, $pw);   //接続

$sth = $dbh->prepare($sql);         //SQL準備

$sth->execute();  //実行

//ユーザー番号の返却
$sql = 'select max(id) from player';
$sth = $dbh->prepare($sql); 
$sth->execute();  //実行
$result=$sth->fetch(PDO::FETCH_ASSOC);

header('Access-Control-Allow-Origin: *');

echo json_encode($result['max(id)']);
