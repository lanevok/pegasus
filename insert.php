<?php
session_start();

require 'method.php';
require 'config.php';

// 多量リクエスト対策
$api = new WebPage();
$api->hugeRequest();
unset($api);

// CSRF対策
$srv = new WebPage();
$srv->checkToken($_SESSION['token'], $_POST['token']);
unset($srv);

// セッションとクッキーの破棄
$_SESSION['login'] = array();
if(isset($_COOKIE['login'])){
	setcookie("login",'',time()-86400,'/');
}
session_destroy();

// POSTテキストのエスケープ
$tweet_text = htmlspecialchars($_POST['tweet_text']);

if(mb_strlen($tweet_text)==0){
	$api = new WebPage();
	$api->SimplePage("error","ADD Error", "ピースの内容がないので、登録できません");
	return;
}
else if(mb_strlen($tweet_text)>140){
	$api = new WebPage();
	$api->SimplePage("error","ADD Error", "ピースの長さが140字を越えているので、登録できません");
	return;
}

// mySQLでaddの実行
$srv = new SQL();
$srv->add($tweet_text);

$srv = new WebPage();
$srv->SimplePage("info", "登録完了", "ピースの登録が完了しました。");
unset($srv);

