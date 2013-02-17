<?php
session_start();
// セッションとクッキーの破棄
$_SESSION['login'] = array();
if(isset($_COOKIE['login'])){
	setcookie("login",'',time()-86400,'/');
}
session_destroy();

require_once('template.php');
require 'method.php';

// 多量リクエスト対策
$api = new WebPage();
$api->hugeRequest();
unset($api);

print_r(plate_define1);
print_r(plate_define2);
print_r(plate_header1);
?>
<li class="active"><a href="index.php">Home</a></li>
<li><a href="./info.php">Info</a></li>
<?php
print_r(plate_header2);
?>
<div class="alert alert-info">
  <strong>News : </strong>本日、Pegasus をリリースしました。
</div>
<div class="hidden-phone">
	<div class="jumbotron"
		style="background-image: url(./res/pegasus_min.png); background-repeat: no-repeat">
		<h1 style="text-align: right">Pegasus !!</h1>
		<br> <br>
		<p class="lead" style="text-align: right">能小16期 の 「名言」や「思い出」 をまとめた</p>
		<p class="lead" style="text-align: right">ツイッターボット 『ペガサス(@pega3s)』</p>
		<p class="lead" style="text-align: right">の リモコン ウェブページ です！</p>
		<br> <br> <a class="btn btn-large btn-success" href="./menu.php">ペガサス
			を 呼ぶ ♪</a>
	</div>
</div>
<div class="visible-phone">
	<div class="jumbotron">
		<h3 style="text-align: center; line-height: 1.7em">
			能小 16 期 <br>「名言」 や 「思い出」<br>まとめた Twitter ボット<br>『ペガサス @pega3s 』
		</h3>
		<br> <img src="./res/pegasus_min.png"><br> <br> <a
			class="btn btn-large btn-success" href="./menu.php">ペガサス を 呼ぶ ♪</a>
	</div>
</div>
<hr>
<div class="row-fluid marketing">
	<div class="span6">
		<h4>ペガサスは 『聞き上手』</h4>
		<div class="hidden-phone">
			<p>
				こちらのページからPegasusにアクセスすることで、<br>ペガサスに名言や思い出を伝えることができます。
			</p>
		</div>
		<div class="visible-phone">
			<p>こちらのページからPegasusにアクセスすることで、ペガサスに名言や思い出を伝えることができます。</p>
		</div>
	</div>
	<div class="span6">
		<div class="visible-phone">
			<br>
		</div>
		<h4>ペガサスは 『寝ない』</h4>
		<div class="hidden-phone">
			<p>
				ペガサスがフォローするユーザの発言を監視し、<br>即リプライを飛ばすことができます。
			</p>
		</div>
		<div class="visible-phone">
			<p>ペガサスがフォローするユーザの発言を監視し、即リプライを飛ばすことができます。</p>
		</div>
	</div>
</div>
<a href="https://twitter.com/pega3s" class="twitter-follow-button" data-show-count="false" data-lang="ja" data-size="large">@pega3s さんをフォロー</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://lanevok.com/pegasus/" data-text="能小16期のボットはこちら" data-via="highta2" data-lang="ja" data-size="large">ツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<?php
print_r(plate_footer);
?>