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
	<div class="span6">
		<h4>ペガサスに 『伝える』</h4>
		<p>「思い出」や「名言」をペガサスに登録します。</p>
		<p>母校の同期か パスワードにより認証します。</p>
		<a class="btn btn-success" href="./login.php">伝える</a><br> <br> <br>
		<h4>ペガサスを 『調教する』</h4>
		<p>管理者モードを展開します。</p>
		<p>一般ユーザは使用できません。</p>
		<a class="btn btn-warning" href="./login.php">調教する</a><br> <br> <br>
		<h4>ペガサスの 『性格を見る』</h4>
		<p>技術仕様に関してはこちらからどうぞ。</p>
		<a href="tech.php" class="btn btn-info" type="button">性格を見る</a><br><br><br>
	</div>
	<div class="span6">
		<h4>ペガサスを 『呼んだ』</h4>
		<h1>
			<?php
			$api = new WebPage();
			print_r($api->count("counter"));
			unset($api);
			?>
		</h1>
		<p>ペガサスにアクセスされた回数です。</p>
		<br> <br>
		<h4>ペガサスが 『覚えた』</h4>
		<h1>
			<?php
			$api = new SQL();
			print_r($api->tupleNum());
			unset($api);
			?>
		</h1>
		<p>ペガサスに登録されているピースの総数です。</p>
	</div>
</div>
<a class="twitter-timeline" href="https://twitter.com/pega3s" data-widget-id="302288073528578048">@pega3s からのツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<?php
print_r(plate_footer);
?>