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
?>
<li><a href="./index.php">Home</a></li>
<li class="active"><a href="./info.php">Info</a></li>
<?php
print_r(plate_header2);
?>
<div class="row-fluid marketing">
	<div class="span6">
		<h4 class="text-success">CEO (Chief Executive Officer)</h4>
		<h3>Mr. G</h3>
		<p>
			最高経営責任者G氏。<br>Pegasusの経営に関わる重大な人
		</p>
		<h4 class="text-success">CTO (Chief Technology Officer)</h4>
		<h3>Mr. K</h3>
		<p>
			最高技術責任者K氏。<br>Pegasusの開発また管理を行う人
		</p>
	</div>
	<div class="span6">
		<h4 class="text-success">CKO (Chief Knowledge Officer)</h4>
		<h3>Mr. F</h3>
		<p>
			最高知識責任者F氏。<br>Pegasusの知識的要素を構築する人
		</p>
		<h4 class="text-success">CIO (Chief Information Officer)</h4>
		<h3>Ms. R</h3>
		<p>
			最高情報責任者R氏。<br>Pegasusの運営で情報戦を繰り広げる人
		</p>
	</div>
</div>
<hr>
<div class="row-fluid marketing">
	<div class="span8">
		<h3>沿革</h3>
		<table class="table table-bordered">
		<tr>
		<th>2010/11/3</th>
		<th>Jingu's Girlfriend 誕生</th>
		</tr>
		<tr>
		<th>2012/11/10</th>
		<th>Jingu's Girlfriend Group 発足</th>
		</tr>
		<tr>
		<th>2013/1/17</th>
		<th>Pegasus Project 始動</th>
		</tr>
		<tr>
		<th>2013/2/21</th>
		<th>Pegasus 公開</th>
		</tr>
		</table>
	</div>
</div>
<a href="contact.php" class="btn btn-info" type="button">運営への連絡フォーム</a>
<hr>
<div class="row-fluid marketing">
	<div class="span12">
		<h3>利用規約</h3>
		この度は、 Pegasus へお越し頂きまことにありがとうございます。<br>
		このウェブサイト（http://lanevok.com/pegasus/、以下「当サイト」といいます）は <br> Jingu's
		Girlfriend Group (以下「当運営」といいます) が運営しております。<br>
		当サイトをご利用されるにあたっては、以下の利用規約をお読み頂き、同意される場合にのみご利用下さい。<br>
		なお、本規約につきましては予告なく変更することがありますので、あらかじめ御了承下さい。<br> <br>
		<h4>第１条【サービス】</h4>
		１．当サイトの利用に際してはウェブにアクセスする必要がありますが、<br>
		利用者は自らの費用と責任に必要な機器・ソフトウェア・通信手段等を用意し適切に接続・操作することとします。<br> <br>
		２．当サイトは情報の提供を行っておりますが、<br> 将来、様々なサービスを追加したり、または変更・削除することがあります<br> <br>
		３．当サイトが提供及び付随するサービスに対する保証行為を一切しておりません。<br>
		また、当サイトの提供するサービスの不確実性・サービス停止等に起因する利用者への損害について、<br>
		一切責任を負わないものとします。詳細については、「免責事項」をご覧下さい。<br> <br>
		<h4>第２条【個人情報の取り扱い】</h4>
		当サイトとの利用に際して利用者から氏名、メールアドレス、住所、<br> 電話番号等の個人情報を要求し、取り扱うことはありません。<br> <br>
		<h4>第３条【著作権等知的財産権】</h4>
		当サイト内のプログラム、その他の知的財産権は当運営に帰属します。<br>
		利用者は、当該情報を私用目的で利用される場合にかぎり使用できます。<br>
		無断で、それを越えて、使用（複製、送信、譲渡、二次利用等を含む）することは禁じます。<br> <br>
		<h4>第４条【禁止事項】</h4>
		１．当運営は、利用者が以下の行為を行うことを禁じます。<br>
		&emsp;１）当運営または第三者に損害を与える行為、または損害を与える恐れのある行為<br>
		&emsp;２）当運営または第三者の財産、名誉、プライバシー等を侵害する行為、または侵害する恐れのある行為<br>
		&emsp;３）公序良俗に反する行為、またはその恐れのある行為<br> &emsp;４）虚偽の申告を行う行為<br>
		&emsp;５）コンピュータウィルス等有害なプログラムを使用する行為<br>
		&emsp;６）その他、法令に違反する行為、またはその恐れがある行為<br> &emsp;７）その他当運営が不適切と判断する行為<br> <br>
		２．上記に違反した場合、当運営は利用者に対し何からの処置を講じることを利用者は同意します。<br> <br>
		<h4>第５条【免責事項】</h4>
		１．当運営は、当サイトに掲載されている全ての情報を慎重に作成し、また管理しますが、<br>
		その正確性および完全性などに関して、いかなる保証もするものではありません。<br> <br>
		２．当運営は、予告なしに、本サイトの運営を停止または中止し、<br>
		また当サイトに掲載されている情報の全部または一部を変更する場合があります。<br> <br>
		３．利用者が当サイトを利用したこと、または何らかの原因によりこれをご利用できなかったことにより生じる<br>
		一切の損害および第三者によるデータの書き込み、不正なアクセス等に関して生じる一切の損害について、<br>
		弊社は、何ら責任を負うものではありません。<br> <br> （附則）<br> <br> 本規約は、2013年 2月
		21日より施行致します。<br> <br> 2013年 2月 21日制定<br>
	</div>
</div>
<?php
print_r(plate_footer);
?>