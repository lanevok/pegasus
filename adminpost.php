<?php
session_start();

require 'method.php';

// 多量リクエスト対策
$api = new WebPage();
$api->hugeRequest();
unset($api);

// CSRF対策
$srv = new WebPage();
$srv->checkToken($_SESSION["token"], $_POST["token"]);
unset($srv);

// セッションとクッキーの破棄
$_SESSION['login'] = array();
if(isset($_COOKIE['login'])){
	setcookie("login",'',time()-86400,'/');
}
session_destroy();

// POSTテキストをエスケープして変数に格納
$tweet_text = htmlspecialchars($_POST['tweet_text']);

if(mb_strlen($tweet_text)==0){
	print '<h3>内容がありません</h3>';
	return;
}
else if(mb_strlen($tweet_text)>140){
	print '<h3>140字を越えています</h3>';
	return;
}

// Twitterへのコネクションと実行
$srv = new Twitter();
$srv->post($tweet_text);
unset($srv);

print "<h2>呟きが完了しました</h2>";
