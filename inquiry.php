<?php
session_start();

// ログイン認証済み(admin権限)確認
if($_SESSION['login']==""||!isset($_SESSION['login'])||$_SESSION['login']=="user"){
	print "<h2>認証されていません</h2>";
	$_SESSION['login'] = array();
	if(isset($_COOKIE['login'])){
		setcookie("login",'',time()-86400,'/');
	}
	session_destroy();
	exit();
}

require 'method.php';

// 多量リクエスト対策
$api = new WebPage();
$api->hugeRequest();
unset($api);

// mySQLのinquiry実行
$srv = new SQL();
$result = $srv->inquiry();
unset($srv);

// タプルの数を出力
// print "<h3>Number of Pieces : ".mysql_num_rows($result)."</h3>";

print "<a href=\"./adminform.php\">adminform</a>";

// テーブルの生成
echo "<table border=\"1\" frame=\"box\">";
echo "<tr>
		<th>id</th>
		<th>tweet_text</th>
		<th>created</th>
		<th>updated</th>
		<th>posted</th>
		<th>user</th>
		<th>ban</th>
		<th>cnt</th>
		</tr>";

while ($tuple = mysql_fetch_array($result)){
	echo "<tr>";
	echo "<td>".$tuple["id"]."</td>";
	echo "<td>".$tuple["text"]."</td>";
	echo "<td>".$tuple["created"]."</td>";
	echo "<td>".$tuple["updated"]."</td>";
	echo "<td>".$tuple["posted"]."</td>";
	echo "<td>".$tuple["uesr"]."</td>";
	echo "<td>".$tuple["ban"]."</td>";
	echo "<td>".$tuple["cnt"]."</td>";
	echo "</tr>";
}
echo "</table>";
