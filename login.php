<?php
require_once 'template.php';
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
<br>
<form class="form-horizontal" action="auth.php" method="post" enctype="multipart/form-data">
	<div class="control-group">
		<label class="control-label" for="inputPassword">Password</label>
		<div class="controls">
			<input type="password" name="pw" id="inputPassword" placeholder="Password">
		</div>
	</div>
	<div class="control-group">
	<div class="controls">
		<button type="submit" class="btn btn-primary">Login</button>
	</div>
	</div>
</form>
<br><br>
<p>※パスワードは卒業アルバムの制作を請け負った印刷事業/写真館の「電話番号下四桁」です。</p>
<p>確認できない方は、<a href="./contact.php">こちら</a> のお問い合わせより<br>「ご自身のTwitterID」と「同期を特定できる情報」を付加してお知らせください。</p>
<?php
$api = new WebPage();
$api->whiteLine();
unset($api);
print_r(plate_footer);
?>