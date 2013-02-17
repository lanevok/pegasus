<?php

require 'method.php';
require 'config.php';

$cronTime = time();
print "<h1><font color=\"#0000FF\">CRON DEAMON</font></h1>";

// ===== データベースの格納内容バックアップ ==========
print "<h3><font color=\"#FF0000\">データベースのバックアップ</font></h3>";
$nowHour = date('H',time());
$nowMins = date('i',time());
// 毎日4時に実行
if($nowHour==4&&$nowMins==0){
	$srv = new SQL();
	$result = $srv->inquiry();
	$write = "<!DOCTYPE html><html><head>
			<meta charset=UTF-8\"></head><body>";
	$write .= "<table border=\"1\" frame=\"box\"><tr>
		<th>id</th>
		<th>tweet_text</th>
		<th>created</th>
		<th>updated</th>
		<th>posted</th>
		<th>user</th>
		<th>ban</th>
		<th>cnt</th>
		</tr>\n";
	while ($tuple = mysql_fetch_array($result)){
		$write .= "<tr><td>".$tuple["id"]."</td><td>"
				.$tuple["text"]."</td><td>".$tuple["created"]."</td><td>"
						.$tuple["updated"]."</td><td>".$tuple["posted"]."</td><td>"
								.$tuple["uesr"]."</td><td>".$tuple["ban"]."</td><td>"
										.$tuple["cnt"]."</td></tr>\n";
	}
	$write .= "</table>";
	$srv = new WebPage();
	$srv->setText("backup", time().".html", $write);
	print "<h4>→バックアップが完了しました";
}
else{
	print "<h4>→バックアップは実行されませんでした";
}


// ===== リプライによるピース登録 ==========
print "<h3><font color=\"#FF0000\">リプライによるピース登録</font></h3>";
$flag = true;
$srv = new Twitter();
$result = $srv->homeTL(20);		// ホームフィード最新20件取得

foreach ($result as $post){
	$text = $post->text;	// 1件ごとのツイート文字列取得

	// 正規表現によりピース登録の対象ツイートか判定する
	if(preg_match("/りんご/", $text)&&preg_match("/みかん/", $text)){
		// ツイート実行日時を取得
		$createdAt = strtotime($post->created_at);
		// リプライ元ツイートIDを取得
		$targetID = $post->in_reply_to_status_id_str;
		// Cron実行とツイート実行のブランク時間
		$blank = $cronTime-$createdAt;
		// Cronのインターバル
		$min5 = 60*5;
		// 不正な対象ツイートを破棄
		if($blank>=$min5||$targetID==NULL) continue;

		// リプライ先のツイート情報を取得する
		$srv = new Twitter();
		$res = $srv->getStatus($targetID);
		// 正規表現によりリプタグの除去
		$addText = preg_replace("/(@[A-Za-z0-9_]{1,15})/", "", $res->text);
		// 先頭からの空白文字除去
		while(true){
			$head = substr($addText, 0,1);
			if($head!=" ") break;
			$addText = substr($addText, 1,strlen($addText));
		}
		// ピース登録依頼者の取得
		$replyUser = $post->user->screen_name;

		// データベースにピースを登録する
		$srv = new SQL();
		$srv->add($addText);

		// ピース登録依頼者に完了通知のリプライを送る
		$srv = new Twitter();
		$srv->postReply("@".$replyUser." "."ピースの登録が完了したよ！",$post->id_str);
		unset($srv);

		print "<h4>→ピース登録は実行されました</h4>";
		print "<p>[".$addText."]</p>";
		$flag = false;
	}
}
if(flag) print "<h4>→ピース登録は実行されませんでした</h4>";

// ===== 臨時アップデート ==========
print "<h3><font color=\"#FF0000\">臨時アップデート</font></h3>";
// 最終臨時アップデートを確認する
$srv = new WebPage();
$lastUpdate = $srv->getText("update");
// 臨時アップデートのインターバル設定と現在時刻の取得
$intervalSec = 60*60*3;		// 前後3時間は発言自重
$intervalHour = 3;
$now = strtotime(date('Y-m-d H:i:s', time()));
$nowHour = date('H',time());
$defaultHout = 23;

// 時刻の条件により発言をしない場合の判定
if($now<$lastUpdate+$intervalSec||$defaultHout-$intervalHour<=$nowHour){
	// 条件：現在秒が最終アップデートから指定秒経過していない または
	// 	現在時間が一般呟き時間から指定時間前のとき
	print "<h4>→臨時アップデートはされませんでした</h4>";
}
else{
	// タイムラインを取得
	$srv = new Twitter();
	$result = $srv->homeTL(50);

	// タイムライン上の最終呟き時刻を取得する
	$LastPostTime = strtotime($result[0]->created_at);

	// ユニークユーザ取得の期限を設定する
	// (最終呟きから指定秒数間のユニークユーザを対象とする)
	$intervalUni = 60*60;	// 1時間

	// ユニークユーザインターバル内におけるユーザの取得
	$appearUserName = array();
	foreach ($result as $post){
		if(strtotime($post->created_at)+$intervalUni<$LastPostTime){
			break;
		}
		array_push($appearUserName, $post->user->id);		// 配列に追加
	}
	// 重複の削除にユニークユーザの取得をする
	$uniqueUser = sizeof(array_unique($appearUserName));

	// タイムラインに出現していたいユニークユーザの数
	$uniqueUserWant = 3;

	// タイムラインに登場するユニークユーザの数による発言をしない場合の判定
	if($uniqueUserWant>$uniqueUser){
		print "<h4>→臨時アップデートはされませんでした</h4>";
	}
	else{
		// 臨時呟きの実行
		$api = new SQL();
		$target = $api->exeTarget();
		$api = new Twitter();
		$api->post($target);
		$api = new WebPage();
		$api->setText("res", "update.txt", $now);
		unset($api);
		print "<h4>→臨時アップデートは実行されました</h4>";
		print "<p>[".$target."]</p>";
	}
}

// ===== 定刻アップデート ==========
print "<h3><font color=\"#FF0000\">定刻アップデート</font></h3>";
$stamp = time();
$hours = date("H",$stamp);
$minutes = date("i",$stamp);

if($hours==23&&$minutes==0){
	$api = new SQL();
	$target = $api->exeTarget();
	$api = new Twitter();
	$api->post($target);
	$api = new WebPage();
	$api->setText("res", "update.txt", $now);
	unset($api);
	print "<h4>→定刻アップデートは実行されました</h4>";
	print "<p>[".$target."]</p>";
}
else{
	print "<h4>→定刻アップデートは実行されませんでした</h4>";
}
