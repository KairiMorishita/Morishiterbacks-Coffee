<?php
//セッション利用の宣言
session_start();

$flg = 0;

//GETされた時
if($_SERVER['REQUEST_METHOD']==="GET"){

//キャンセルボタンがクリックされた時
if(isset($_GET["cancel"])){
$flg=1;

//セッションの削除

//配列の初期化
$_SESSION = array();

//セッション名を取得
$session_name = session_name();

//クッキーが存在している場合、クッキーデータを削除
if(isset($_COOKIE[$session_name]) === TRUE){
	setcookie($session_name,"",time() - 3600);
}

//セッションに関連付けられたデータを削除
session_destroy();

}elseif(isset($_GET["order"])){
$flg=2;


$name    = $_SESSION["name"];
$addr    = $_SESSION["addr"];
$siharai = $_SESSION["siharai"];
$mail    = $_SESSION["mail"];

//カート内のデータを一つにまとめる
$sinakazu = count($_SESSION["cart"]);
$cartdata = "";
$kingaku = 0;
$total = 0;


for($i = 0; $i<$sinakazu; $i++){
	$cartdata .= $_SESSION["cart"][$i]["code"] . ":";
	$cartdata .= $_SESSION["cart"][$i]["hinmei"] . ":";
	$cartdata .= $_SESSION["cart"][$i]["price"] . ":";
	$cartdata .= $_SESSION["cart"][$i]["suu"] . ":";
	
	$kingaku = $_SESSION["cart"][$i]["price"] * $_SESSION["cart"][$i]["suu"];
	$cartdata .= $kingaku .",";
	$total = $kingaku + $total;

}

$hiduke = date("Y-m-d H:i:s");

$data = "";
$data .= $hiduke .",";
$data .= $name .",";
$data .= $addr .",";
$data .= $siharai .",";
$data .= $mail .",";

$data .= $cartdata;
$data .= $total . "\n";

$file = @fopen("orderdata.csv","a")or die("ファイルオープンエラー");
flock($file ,LOCK_EX);
fwrite($file ,$data);
flock($file ,LOCK_UN);
fclose($file);


$_SESSION = array();

$session_name = session_name();

if(isset($_COOKIE[$session_name]) === TRUE){
	setcookie($session_name,"",time() - 3600);
}

session_destroy();
}

}
?>

		<!--ページごと-->
		<link rel="stylesheet" href="css/complete.css">

		<?php include('header.php'); ?>


<div id="container">
	<main>

	<?php if($flg===1){ ?>
		<h2>キャンセル</h2>
		<p>購入をキャンセルしました</p>
	<?php }else{ ?>
		<h2>注文完了</h2>
		<p>注文しました</p>
	<?php } ?>

	</main>
</div>

		<?php include('footer.php'); ?>


</body>
</html>
