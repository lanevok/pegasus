<?php
// Login Authenticate
session_start();

require_once('config.php');
require 'method.php';

// 多量リクエスト対策
$api = new WebPage();
$api->hugeRequest();
unset($api);

sleep(1);

// 多量なログイン試行を回避する
// 	(連続ログイン試行回数を制限し、
//			最悪の場合はシステムを停止させる)
$api = new WebPage();
$count = $api->count(auth);
unset($api);
if($count>5){
	// セッションとクッキーの破棄
	$_SESSION['login'] = array();
	if(isset($_COOKIE['login'])){
		setcookie("login",'',time()-86400,'/');
	}
	session_destroy();

	$api = new WebPage();
	$api->SimplePage("error","System Down",
			"ログイン処理が過剰に動作した為、システムが停止しています<br>
			<a href=\"./contact.php\">管理者</a>にお問い合わせください");
	exit();
}

// パスワードのエスケープ実行
$pw = htmlentities(htmlspecialchars($_POST['pw']));

if(empty($pw)||$pw==''){
	// セッションとクッキーの破棄
	$_SESSION['login'] = array();
	if(isset($_COOKIE['login'])){
		setcookie("login",'',time()-86400,'/');
	}
	session_destroy();

	$api = new WebPage();
	$api->SimplePage("error","Auth Error", "パスワードが入力されていません");

	exit();
}

if(FORM_PASSWORD==$pw){
	$_SESSION['login'] = "user";		// user権限でloginセッションを発行

	$api = new WebPage();
	$api->setText("res","auth.txt", 0);		// ログイン試行の初期化
	unset($api);

	// 自動ページジャンプ
	echo "<meta http-equiv=refresh content=1;URL='./form.php'>\n";
}
else if(ADMIN_PASSWORD==$pw){
	$_SESSION['login'] = "admin";		// admin権限でloginセッションを発行

	$api = new WebPage();
	$api->setText("res","auth.txt", 0);		// ログイン試行の初期化
	unset($api);

	// 自動ページジャンプ
	echo "<meta http-equiv=refresh content=1;URL='./inquiry.php'>\n";
}
else{
	// セッションとクッキーの破棄
	$_SESSION['login'] = array();
	if(isset($_COOKIE['login'])){
		setcookie("login",'',time()-86400,'/');
	}
	session_destroy();

	$api = new WebPage();
	$api->SimplePage("error","Auth Error","パスワードが違います");
	unset($api);
}