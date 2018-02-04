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

//一致しているか判定後スコア加算
function addscore($s,$u,$c,$d){
	$result=0;
	if($u==$c&&$u==$d){
		$result=$s;
	}
	return $result;
}

//各役の判別
switch($up){
	case 0:
		$score+=addscore(50,$up,$center,$down);
		break;
	case 1:
		$score+=addscore(100,$up,$center,$down);
		break;
	case 2:
		$score+=addscore(150,$up,$center,$down);
		break;
	default:
		
		break;
}
//ユーザー追加
//$sql = 'update player set '+$target+'='+$type+',score='+$score' where id='+$id;
$sql = "update player set $target=$type,score=$score where id=$id";


$sth = $dbh->prepare($sql);         //SQL準備

$sth->execute();  //実行


header('Access-Control-Allow-Origin: *');

echo json_encode($score);
