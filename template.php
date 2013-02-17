<?php
// Page Template

define('plate_define1','<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>Pegasus</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="能小16期Twitterボットのリモコンウェプページです">
<mata name="keywords" content="Pega3s,Pegasus,能小,Jingu\'s Girlfriend">
<mata name="copyright" content="Jingu\'s Girlfriend">
<meta name="author" content="Jingu\'s Girlfriend">
<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
body {
padding-top: 20px;
padding-bottom: 40px;
}
.container-narrow {
margin: 0 auto;
max-width: 700px;
}
.container-narrow > hr {
margin: 30px 0;
}
.jumbotron {
margin: 60px 0;
text-align: center;
}
.jumbotron h1 {
font-size: 72px;
line-height: 1;
}
.jumbotron .btn {
font-size: 21px;
padding: 14px 24px;
}
.marketing {
margin: 60px 0;
}
.marketing p + h4 {
margin-top: 28px;
}
</style>
<link href="./bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push([\'_setAccount\', \'UA-32520755-1\']);
_gaq.push([\'_trackPageview\']);
(function() {
var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
');

define('plate_define2','
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Fav and touch icons
<link rel="shortcut icon" href="./bootstrap/ico/favicon.png"> -->
</head>
');

define('plate_header1','
<body>
<div class="container-narrow">
<div class="masthead">
<ul class="nav nav-pills pull-right">
');

define('plate_header2','
</ul>
<h3 class="muted">Pegasus</h3>
</div>
<hr>
');

define('plate_home','
<li><a href="./index.php">Home</a></li>'
);

define('plate_footer','
<hr>
<div class="footer">
<p>Jingu&rsquo;s Girlfriend Group 2013</p>
</div>
</div>
</body>
</html>
');
