<?php
session_start();

// ログイン認証済み確認
if($_SESSION['login']==""||!isset($_SESSION['login'])){
	print "<h2>認証されていません</h2>";
	$_SESSION['login'] = array();
	if(isset($_COOKIE['login'])){
		setcookie("login",'',time()-86400,'/');
	}
	session_destroy();
	exit();
}

require_once 'template.php';
require 'method.php';

// 多量リクエスト対策
$api = new WebPage();
$api->hugeRequest();
unset($api);

// CSRF対策
$srv = new WebPage();
$_SESSION['token'] = $srv->createToken();

print_r(plate_define1);
print_r("<script src=\"http://code.jquery.com/jquery-1.7.1.min.js\"></script>");
print_r(plate_define2);
print_r(plate_header1);
print_r(plate_home);
print_r(plate_header2);
?>
<h4>ペガサスに 『伝える』</h4>
<div class="row-fluid marketing">
	<div class="span6">
		<form action="insert.php" method="post" enctype="multipart/form-data">
			<textarea id="tweet_text" name="tweet_text" cols="70" rows="13"></textarea>
			<input type="hidden" name="token" value="<?php print_r($_SESSION['token']);?>">
			<h4 id="count"></h4>
			<br>
			<button type="submit" class="btn btn-info">送信</button>
		</form>
		<br>
	</div>
	<div class="span6">
		<h5>ピース(名言/思い出 など)の登録に関して</h5>
		<p>フォームにピースの内容を入力して<br>「送信」ボタンを押してください。</p>
		<p>文字数が140字を越える場合また<br>文字を入力せずに送信はすることはできません。</p>
		<p>入力する内容に「氏名」「あだ名」を含めることは<br>名誉毀損となりますのでご遠慮ください。</p>
		<p>極めて不適切な登録が行われた場合は、<br>当方で判断し削除させて頂く可能性があります。</p>
	</div>
</div>
<script>
$(function() {
    var limit = 140;
    $('#count').text(limit);
    $('#tweet_text').keyup(function() {
        count = (limit - $(this).val().length);
        if(count>=0){
            $('#count').text(count);
            $('#count').css('color', 'black');
        }
        else{
        	 $('#count').text(count);
        	 $('#count').css('color', 'red');
        }
    });
});
</script>
<?php
$api = new WebPage();
$api->whiteLine();
unset($api);
print_r(plate_footer);
?>