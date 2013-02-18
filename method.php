<?php

require_once 'config.php';
require 'template.php';

/**
 * Twitterクラス
 * @author (TAT)chaN
 * @copyright lanevok.com
 * @since 2013.2.17
 * @version 1.1
 *
 */
Class Twitter {
	var $conn;

	/**
	 * Twitter のコネクションを生成 (OAuth)
	 */
	public function Twitter(){
		require_once 'twitteroauth/twitteroauth.php';
		$this->conn = new TwitterOAuth(
				CONSUMER_KEY, CONSUMER_SECRET,
				ACCESS_TOKEN,ACCESS_TOKEN_SECRET);
	}

	/**
	 * Twitterで呟く
	 * @param unknown $tweet_text 呟くテキスト
	 */
	public function post($tweet_text){
		$params = array('status' => $tweet_text);
		$this->conn->post('statuses/update',$params);
	}

	/**
	 * リプライを飛ばす
	 * @param unknown $tweet_text リプライのテキスト
	 * @param unknown $replyID リプライ先のツイートID
	 */
	public function postReply($tweet_text, $replyID){
		$params = array('status' => $tweet_text, 'in_reply_to_status_id' => $replyID);
		$this->conn->post('statuses/update',$params);
	}

	/**
	 * Twitterのホームフィード(タイムライン)を取得する
	 * @param unknown $count 最新からの取得件数
	 * @return Ambigous <mixed, API> タイムライン
	 */
	public function homeTL($count){
		$params = array('count' => $count);
		return $this->conn->get('statuses/home_timeline',$params);
	}

	/**
	 * 指定したユーザのタイムラインを取得する
	 * @param unknown $user 取得するユーザ名(スクリーンネーム)
	 * @return Ambigous <mixed, API> タイムライン
	 */
	public function userTL($user){
		$params = array("screen_name" => $user);
		return $this->conn->get('statuses/user_timeline',$params);
	}

	/**
	 * 管理者(運営)にダイレクトメッセージを送る
	 * @param unknown $text 送信するDMの本文
	 */
	public function AdminDM($text){
		$text = htmlspecialchars($text);
		$params = array("screen_name" => "lanevok","text"=>$text);
		$this->conn->post('direct_messages/new',$params);
	}

	/**
	 * 指定したIDの呟きを取得する
	 * @param unknown $statusID 取得する呟きのID
	 * @return Ambigous <mixed, API> 指定した呟きIDに関する情報
	 */
	public function getStatus($statusID){
		$params = array("id" => $statusID);
		return $this->conn->get('statuses/show',$params);
	}
}

/**
 * mySQLクラス
 * @author (TAT)chaN
 * @copyright lanevok.com
 * @since 2013.2.18
 * @version 1.2
 *
 */
Class SQL {
	var $conn;

	/**
	 * mySQL データベースのコネクションを生成
	 * 	サーバ・アカウント・データベースパスワードで認証
	 * 	スキーマの選択・クエリ実行の文字コード設定
	 */
	public function SQL(){
		$this->conn = mysql_connect(SERVER,DB_ACCOUNT,DB_PASSWORD) or die('DB Connection Error');
		$this->result = mysql_select_db(DB_SCHEMA,$this->conn) or die('DB Selection Error');
		mysql_query("SET NAMES UTF8") or die("UTF-8 Setting Error");
	}

	/**
	 * mySQL データベースのコネクション切断(クローズ)
	 */
	private function close(){
		$this->conn = mysql_close($this->conn) or die('Database Close Error');
	}

	/**
	 * データベースにピースを新規登録する
	 * @param unknown $text 登録するピースの内容
	 */
	public function add($text){
		$api = new WebPage();
		$id = $api->count("id");
		unset($api);
		$text = htmlspecialchars($text);
		// PHP->mySQL datatime UPDATE => date("Y-m-d H:i:s",time())
		$query = 'INSERT INTO `'.DB_SCHEMA.'`.`'.DB_TABLE.'` (id, text, created) VALUES ('
				.$id.',\''.$text.'\',\''.date("Y-m-d H:i:s",time()).'\');';
		mysql_query($query,$this->conn) or $this->Error();
		$this->close();
	}

	/**
	 * データベースの内容をすべて取得する
	 * @return resource データベースの内容を全て
	 */
	public function inquiry(){
		$query = 'SELECT * FROM `'.DB_TABLE.'`';
		$result = mysql_query($query,$this->conn) or $this->Error();
		$this->close();
		return $result;
	}

	/**
	 * 指定したSQLを実行する
	 * @param unknown $query SQL文
	 * @return resource SQL実行結果
	 */
	public function execute($query){
		$result = mysql_query($query,$this->conn) or $this->Error();
		return $result;
	}

	/**
	 * タプルの総数を取得する
	 * @return number タプルの総数
	 */
	public function tupleNum(){
		$srv = new SQL();
		$result = $srv->inquiry();
		return mysql_num_rows($result);
	}

	/**
	 * 指定したIDのタプルをデータベースから削除する
	 * @param unknown $deleteID 削除するタプルのID
	 */
	public function delete($deleteID){
		$query = 'DELETE FROM `'.DB_TABLE.'` WHERE id = '.$deleteID;
		$result = mysql_query($query,$this->conn) or $this->Error();
		$this->close();
	}

	/**
	 * データベースから1つの文字列をランダムで抽出し情報を更新する
	 * @return Ambigous <> 抽出した1つの文字列
	 */
	public function exeTarget(){
		// posted でソートし全てのタプルを抽出する
		$query = "SELECT * FROM `".DB_TABLE."` ORDER BY posted";
		$srv = new SQL();
		$result = $srv->execute($query);
		$max = mysql_num_rows($result);		// 総タプル数
		$random = rand(0,$max/2);					// 真ん中より前(1/2)に対して1つ選択
		mysql_data_seek($result, $random);		// SQL結果のポインタをずらす
		$tuple = mysql_fetch_array($result);		// SQL結果を配列として抽出
		// cntのインクリメント・postedの更新を行う
		$query = "UPDATE `".DB_SCHEMA."`.`".DB_TABLE."` SET cnt = ".
				++$tuple['cnt'].", posted = '".date("Y-m-d H:i:s",time())."' WHERE id = ".$tuple['id'].";";
		$srv->execute($query);
		return $tuple['text'];
	}

	/**
	 * mysql_error処理
	 * 	(エラー発生の表示とログの保存)
	 */
	private function Error(){
		print "<h2>なんらかのエラーが発生しました</h2>";
		$api = new WebPage();
		$api->setText("log",time().rand(0, 9999).".txt",mysql_error());
		die();
// 		die(mysql_error());
	}
}

/**
 * Pegasus WebPageクラス
 * @author (TAT)chaN
 * @copyright lanevok.com
 * @since 2013.2.15
 * @version 1.1
 *
 */
Class WebPage {

	/**
	 * いくつかの改行を挿入する
	 */
	public function whiteLine(){
		for($i=0;$i<5;$i++){
			print "<br>";
		}
	}

	/**
	 * シンプルページを出力する
	 * @param unknown $type ページの種類
	 * @param unknown $title タイトル文字列
	 * @param unknown $body 本文文字列
	 */
	public function SimplePage($type, $title, $body){
		require 'template.php';
		print_r(plate_define1);
		print_r(plate_define2);
		print_r(plate_header1);
		print_r(plate_home);
		print_r(plate_header2);
		if($type=="error"){
			print "<div class=\"alert alert-error\">";
		}
		else if($type=="info"){
			print "<div class=\"alert alert-info\">";
		}
		print "<h4>".$title."</h4><br>";
		print_r($body);
		print "</div>";
		$this->whiteLine();
		print_r(plate_footer);
	}

	/**
	 * カウンタ処理を実行する
	 * @param unknown $target 対象となるカウンタ
	 * 	(テキストリソースと名前を一致させる必要あり)
	 * @return string 現在の値
	 */
	public function count($target){
		$counter_file = './res/'.$target.'.txt';
		$counter_length = 4;
		$fp = fopen($counter_file, 'r+');
		if($fp){
			if(flock($fp, LOCK_EX)){
				$counter = fgets($fp, $counter_length+1);
				$counter++;
				rewind($fp);
				if(fwrite($fp, $counter)==FALSE){
					print "カウンタログに書き込み失敗";
				}
				flock($fp, LOCK_UN);
			}
		}
		fclose($fp);

		$format = '%0'.$counter_length.'d';
		$new_counter = sprintf($format, $counter);
		return $new_counter;
	}

	/**
	 * 指定したテキストファイルにテキストを書き込む
	 * @param unknown $folder 書き込むファイルのフォルダ
	 * @param unknown $target 書き込むファイル(拡張子入り)
	 * @param unknown $text 書き込むテキストの内容
	 */
	public function setText($folder, $target, $text){
		$counter_file = './'.$folder.'/'.$target;
		$fp = fopen($counter_file, 'w');
		if($fp){
			if(flock($fp, LOCK_EX)){
				if(fwrite($fp, $text)==FALSE){
					print "書き込み失敗";
				}
				flock($fp, LOCK_UN);
			}
		}
		fclose($fp);
	}

	/**
	 * 指定したテキストファイルのテキストを読み込む
	 * @param unknown $target 読み込むテキストファイル
	 * @return string 取得したテキスト
	 */
	public function getText($target){
		$file = './res/'.$target.'.txt';
		$length = 10;
		$fp = fopen($file, 'r');
		if($fp){
			if(flock($fp, LOCK_EX)){
				$number = fgets($fp, $length+1);
				flock($fp, LOCK_UN);
			}
		}
		fclose($fp);
		return $number;
	}

	/**
	 * サービス停止また多量アクセスによる自動的機能停止
	 */
	public function hugeRequest(){
		$srv = new WebPage();
		$run = $srv->getText(run);
		if($run!="run"){
			print "<h1>サービスを全て停止しています</h1>";
			print "<h2>暫くの間お待ちください</h2>";
			exit();
		}
		$rand = rand(0, 9999);
		if($rand==0){
			$api = new WebPage();
			$api->SimplePage("error","Request Error", "ページを再度読み込んでください");
			unset($api);
			exit();
		}
	}

	/**
	 * ワンタイムトークンの生成
	 * 	CSRF (Cross Site Request Forgeries) 対策
	 * @return string ワンタイムトークン文字列
	 */
	public function createToken(){
		return sha1(uniqid(mt_rand(), true));
	}

	/**
	 * ワンタイムトークンの正当性検証
	 * 	(不正の場合は強制終了)
	 * @param unknown $SessionTK セッションのトークン文字列
	 * @param unknown $PostTK フォーム(POST)のトークン文字列
	 */
	public function checkToken($SessionTK, $PostTK){
		if(empty($SessionTK)||$SessionTK!=$PostTK){
			$_SESSION['login'] = array();
			if(isset($_COOKIE['login'])){
				setcookie("login",'',time()-86400,'/');
			}
			session_destroy();
			$api = new WebPage();
			$api->SimplePage("error","POST Error", "不正なポストが実行されました");
			exit();
		}
	}
}
