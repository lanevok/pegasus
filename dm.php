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
$_SESSION["token"] = array();
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
	$api = new WebPage();
	$api->SimplePage("error","DM Error", "内容がないので、送信できません");
	unset($api);
	return;
}
else if(mb_strlen($tweet_text)>140){
	$api = new WebPage();
	$api->SimplePage("error","DM Error", "140字を越えているので、送信できません");
	unset($api);
	return;
}

// Twitterへのコネクションと実行
$srv = new Twitter();
$srv->AdminDM($tweet_text);


$srv = new WebPage();
$srv->SimplePage("info", "メッセージ送信", "運営にメッセージを送信しました。");
unset($srv);
