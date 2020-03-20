<?php
//セッション利用の宣言
session_start();

$name = $_SESSION["name"];
$addr = $_SESSION["addr"];
$siharai = $_SESSION["siharai"];
$mail = $_SESSION["mail"];

?>


		<!--ページごと-->
		<link rel="stylesheet" href="css/regi_kakunin.css">

		<?php include('header.php'); ?>


<div id="container">
	<main>
	<p>以下の内容を確認し、よろしければ「注文情報を確定する」ボタンをクリックして下さい。</p>

		<form method="post" action="regi.php">

		<h2>購入情報確認</h2>
		<h3>購入商品</h3>
		<?php
		$sinakazu = count($_SESSION["cart"]);
		$kingaku = 0;
		$subtotal = 0;
		?>


		<table>
			<tr>
				<th>商品コード</th>
				<th>商品名</th>
				<th>販売価格（税込み）</th>
				<th>個数</th>
				<th>金額</th>
			</tr>

			<?php for($i=0; $i< $sinakazu; $i++) { ?>
			<tr>
				<td><?php echo $_SESSION["cart"][$i]["code"]; ?></td>
				<td><?php echo $_SESSION["cart"][$i]["hinmei"]; ?></td>
				<td><?php echo $_SESSION["cart"][$i]["price"]; ?></td>
				<td><?php echo $_SESSION["cart"][$i]["suu"]; ?>個</td>
				<td>
					<?php
						$kingaku = $_SESSION["cart"][$i]["price"] * $_SESSION["cart"][$i]["suu"];
						echo $kingaku;
						$subtotal = $kingaku + $subtotal ;
					?>円
				</td>
			</tr>
			<?php } ?>

			<tr>
				<td colspan="4">小計</td>
				<td><?php echo $subtotal; ?>円</td>
			</tr>
			</table><br>


	<a href="cart.php">購入商品を変更する</a>


				<h3>購入者情報確認</h3>

		<table>
			<tr>
				<th>名前</th>
				<td><?php echo $name; ?></td>
			</tr>
			<tr>
				<th>住所</th>
				<td><?php echo $addr; ?></td>
			</tr>
			<tr>
				<th>お支払方法</th>
				<td>
						<?php
								if($siharai === "1"){
										echo "クレジットカード";
										}elseif($siharai === "2"){
										echo "代金引き替え";
										}elseif($siharai === "3"){
										echo "口座振替（自動引き落とし）";
										}elseif($siharai === "4"){
										echo "コンビニ決済";
										}
							?>
				</td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td><?php echo $mail; ?></td>
			</tr>
		</table>
	</form>

	<a href="regi.php">購入者情報を変更する</a>

	<form method="get" action="complete.php">
		<div class="btn">
			<button type="submit" name="cancel">
				<p><img src="images/cancel.png" alt="注文をキャンセルする"></p>
			</button>

			<button type="submit" name="order">
				<p><img src="images/order.png" alt="注文を確定する"></p>
			</button>
		</div>
	</form>

	</main>
</div>

		<?php include('footer.php'); ?>

</body>
</html>
