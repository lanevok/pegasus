<?php
require_once('template.php');
require 'method.php';

// 多量リクエスト対策
$api = new WebPage();
$api->hugeRequest();
unset($api);

print_r(plate_define1);
print_r(plate_define2);
print_r(plate_header1);
print_r(plate_home);
print_r(plate_header2);
?>
<div class="row-fluid marketing">
	<div class="span12">
		<h3>技術仕様</h3>
		現在動作しているペガサスの仕様については以下の通りです。<br> <br>
		<h4>【定刻呟き】</h4>
		<p>毎日[23時0分]に1つ呟きます。呟く内容については以下の通りです。</p>
		<ul>
			<li>登録されたピース(名言や思い出の1要素のこと)の中からランダムに1つ選ぶ</li>
			<li>ただし、一度呟いたピースに関しては、ピースの登録要素総数÷２をした数の日数間は呟かない</li>
		</ul>
		<br>
		<h4>【臨時呟き】</h4>
		<p>
			ペガサスがフォローしているユーザに対して複数のユーザ(現在は3Users)が<br>
			1時間以内に呟きを行っていた場合、定刻呟きと同様のピース選択アルゴリズムで呟く。<br>
			ただし、以下の条件を考慮する。
			<ul>
			<li>最後の呟きから3時間が経過してない場合は呟かない</li>
			<li>定刻呟きの3時間前から定刻呟きまでの間は呟かない</li>
			</ul>
		<br>
		<h4>【リプライによるピース登録】</h4>
		<p>
			ペガサスがフォローしているユーザに対して、<br>
			リプライにより「ペガサス」かつ「登録」というワードが呟きに含まれていた場合、<br>
			リプライ元のツイートをペガサスに自動登録し、登録処理完了を通知する。
		</p>
		<br>
		<h4>【全般】</h4>
		<p>
			タイムラインの監視は24時間稼働でインターバル5分。<br> <br> <br>
		<hr>
		<br>
		<h3>開発者向け</h3>
		学習の一環として開発したものですので、サーバサイドプログラムソースコードを開示します。<br> <br> <a
			href="http://github.com/lanevok/pegasus/" class="btn btn">実行コード群</a><br>
		<br> 開示されたサーバサイドプログラムを利用してペガサスの運営に支障をきたす行為は断じて禁じます。<br>
		脆弱性等の指摘点が御座いましたら、 <a href="contact.php">運営に連絡</a> よりご連絡ください。<br> <br>
		<b>実行環境 (サーバサイド)</b>
		<ul>
			<li>lolipop.jp レンタルサーバ (Apache2)</li>
			<li>lolipop.jp データベース (mySQL 5.1.66)</li>
			<li>PHP 5.3.15 (ローカル開発 5.2.17)</li>
		</ul>
		<b>使用ライブラリ</b>
		<ul>
			<li>twitteroauth (abraham)</li>
			<li>bootstrap v2.2.2 (Twitter, Inc.)</li>
		</ul>
	</div>
</div>
<?php
print_r(plate_footer);
?>