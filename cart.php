<?php
//セッション利用の宣言
session_start();

//$_SESSION["cart"]を用意していない場合
if(!isset($_SESSION["cart"])){
	$_SESSION["cart"]= array();
}


//カートに商品入れたとき
if(isset($_GET["code"])){
	$code 	= $_GET["code"];
	$hinmei = $_GET["hinmei"];
	$price  = $_GET["price"];
	$suu	 	= $_GET["suu"];

//同一商品がカートの中にある場合は数量のみ加算する
$umu = 0;  //0:同一商品なし　1:同一商品あり
$sinakazu = count($_SESSION["cart"]); //すでにカート内にある商品

for($i=0 ; $i<$sinakazu; $i++){
	if($_SESSION["cart"][$i]["code"] === $code){
	$_SESSION["cart"][$i]["suu"] = $_SESSION["cart"][$i]["suu"] + $suu;
	$umu = 1;
	break;
	}
}

 //セッションにデータを保存
	if($umu === 0){
		$i = count($_SESSION["cart"]);
		$_SESSION["cart"][$i]["code"]   = $code;
		$_SESSION["cart"][$i]["hinmei"]   = $hinmei;
		$_SESSION["cart"][$i]["price"]   = $price;
		$_SESSION["cart"][$i]["suu"]   = $suu;
	}

	header("Location: cart.php");
	exit;
}


//カートの中を空にする
if(isset($_GET["delete"])){
	$_SESSION["cart"] =array();

	header("Location: cart.php");
	exit;
}


//任意の商品を削除する
if(isset($_GET["delno"])){
	$delno = $_GET["delno"];
	unset($_SESSION["cart"][$delno]);
	$_SESSION["cart"] = array_values($_SESSION["cart"]);

	header("Location: cart.php");
	exit;
}

?>

		<!--ページごと-->
		<link rel="stylesheet" href="css/cart.css">


		<?php include('header.php'); ?>

<body>
<div id="container">
	<main>
	<h2>ショッピングカート</h2>
	<?php
		$sinakazu = count($_SESSION["cart"]);
		if($sinakazu === 0){
	?>
	<p>現在、カートの中に商品が入っておりません。<br>
	お買い物を続けるには下の「買い物を続ける」をクリックして下さい。</p>


	<?php }else{
	$subtotal = 0;
	$kingaku = 0;

		?>

		<table>
			<tr>
				<th>商品コード</th>
				<th>商品名</th>
				<th>販売価格（税込み）</th>
				<th>個数</th>
				<th>金額</th>
				<th>削除</th>
			</tr>

			<?php for($i=0; $i< $sinakazu; $i++) { ?>
			<tr>
				<td><?php echo $_SESSION["cart"][$i]["code"]; ?></td>
				<td><?php echo $_SESSION["cart"][$i]["hinmei"]; ?></td>
				<td><?php echo $_SESSION["cart"][$i]["price"]; ?>円</td>
				<td><?php echo $_SESSION["cart"][$i]["suu"]; ?>個</td>
				<td>
					<?php
						$kingaku = $_SESSION["cart"][$i]["price"] * $_SESSION["cart"][$i]["suu"];
						echo $kingaku;
						$subtotal = $kingaku + $subtotal ;
					?>円
				</td>
				<td><a href="cart.php?delno=<?php echo $i; ?>">削除</a></td>
			</tr>
			<?php } ?>

			<tr>
				<td colspan="4"><strong>小計</strong></td>
				<td><strong><?php echo $subtotal; ?></strong>円</td>
				<td></td>
			</tr>
			</table>
			<?php } ?>

	</div>

	<div class="btn">
		<a href="cart.php?delete=all"><img src="images/empty.png" alt="カートの中を空にする"></a>
		<a href="goodslist.php"><img src = "images/shopping.png" alt="買い物を続ける"></a>
		<a href="regi.php"><img src = "images/regi.png" alt="レジに進む"></a>
	</div>
	</main>

		<?php include('footer.php'); ?>


</body>
</html>
