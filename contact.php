<?php
session_start();

require_once 'template.php';
require 'method.php';

// 多量リクエスト対策
$api = new WebPage();
$api->hugeRequest();
unset($api);

// CSRF対策
$srv = new WebPage();
$_SESSION["token"] = $srv->createToken();
unset($srv);

print_r(plate_define1);
print_r("<script src=\"http://code.jquery.com/jquery-1.7.1.min.js\"></script>");
print_r(plate_define2);
print_r(plate_header1);
print_r(plate_home);
print_r(plate_header2);
?>
<h4>運営へ連絡</h4>
<div class="row-fluid marketing">
	<div class="span6">
		<form action="dm.php" method="post" enctype="multipart/form-data">
			<textarea id="tweet_text" name="tweet_text" cols="70" rows="13"></textarea>
			<input type="hidden" name="token" value="<?php print_r($_SESSION['token']);?>">
			<h4 id="count"></h4>
			<br>
			<button type="submit" class="btn btn-info">送信</button>
		</form>
		<br>
	</div>
	<div class="span6">
		<p>こちらのフォームで運営に連絡することが出来ます。</p>
		<p>メッセージ内容は140字以内です。</p>
		<p>返信を希望する方は、連絡先を明記してください。</p>
		<p>内容によっては応答することが<br>出来ませんので、予めご了承ください。</p>
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