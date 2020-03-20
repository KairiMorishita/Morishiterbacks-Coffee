<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
		<title>Morishiterbacks Coffee</title>
		<!--リセット-->
		<link rel="stylesheet" href="css/reset.css">
		<!--共通-->
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/responsive.css">
		<link href="https://fonts.googleapis.com/css?family=Sigmar+One&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Kosugi&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic&display=swap" rel="stylesheet">

		<!--js-->
		<script src="js/top.js" charset="UTF-8"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

	</head>

	<script>
$(document).ready(function() {
  var pagetop = $('.pagetop');
    $(window).scroll(function () {
    	if ($(this).scrollTop() > 100) {
            pagetop.fadeIn();
      } else {
            pagetop.fadeOut();
            }
      });
      pagetop.click(function () {
          $('body, html').animate({ scrollTop: 0 }, 500);
              return false;
});
});
</script>

	<body onload="animestart();">
	<div id="wrapper">
		<header class="clearfix">
			<p class="cart"><a href="cart.php"><img src = "images/cart.png" alt="カートの中をみる"></a></p>
		  <a href="index.php"><img src="images/touka.png" class="rogo"></a>
			<p class="catchcopy">頑張る人へ頑張らない時間を</p>
			<h1><a href="index.php">Morishiterbacks Coffee</a></h1>
		</header>

		<nav class="global">
			<ul class="clearfix" id="gnav">
				<li><a href="index.php">HOME<span><br>トップ</span></a></li>
				<li><a href="menues.php">MENU<span><br>メニュー</span></a></li>
				<li><a href="goodslist.php">GOODS<span><br>グッズ</span></a></li>
				<li><a href="service.php">SERVICE<span><br>サービス</span></a></li>
				<li><a href="about.php">SHOP<span><br>店舗案内</span></a></li>
			</ul>
		</nav>
	</div>
